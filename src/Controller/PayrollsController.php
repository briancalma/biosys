<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Payrolls Controller
 *
 * @property \App\Model\Table\PayrollsTable $Payrolls
 *
 * @method \App\Model\Entity\Payroll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PayrollsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Logs');
        $this->loadModel('Users');
        $this->loadComponent('RequestHandler');
        # $this->Auth->allow(['logout','add','signup']);
    }

    public function beforeRender(Event $event) {
        $this->viewBuilder()->setLayout('main');
    }

    public function index()
    {
        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', 'Calendar');   
        
        $this->set(compact('user'));
        $this->set(compact('page'));
    }

    /**
     * View method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($mil = null)
    {

        // $a = new \DateTime('12:00');
        // $b = new \DateTime('12:30');

        // $interval = $a->diff($b);

        // debug( $interval );
        // echo $interval->format("%H");

        # $mil = 1227643821310;
        $seconds = $mil / 1000;
        $date = date("Y-m-d", $seconds);

        $payroll = $this->Payrolls->find() 
                   ->where(['bill_date' => $date])
                   ->contain(['logs'])
                   ->first();

        $data = [];

        $output = [];

        if($payroll != null) {
            
            $user_ids = [];
            $user_logs = $payroll->logs;
           

            # Getting of unique user_id
            foreach ($user_logs as $log) {
                if( !in_array($log->user_id, $user_ids) ) { 
                    array_push($user_ids, $log->user_id);
                }
            }

            foreach($user_ids as $id) {
                $user_log = [];
                foreach ($user_logs as $log) {
                    if($log->user_id == $id) {
                        array_push($user_log, $log);
                    }                    
                }
                
                array_push($data, ["user_id" => $id, "logs" => $user_log ,"user" => $this->getUserData($id),"twh" => 0]);
            }    

            
            foreach($data as $item) {
                
                $log_dates = [];
                $logs = $item['logs'];
                
                $holder = ["user_id" => $item['user_id'], "logs" =>  $item['logs'], "user" => $item["user"], "twh" => 0]; 
        
                $time_totals = [];

                # getting of log dates of the user
                foreach($logs as $log) {
                    if( !in_array($log->log_date, $log_dates) ) { 
                        array_push($log_dates, $log->log_date);
                    }
                }
                
                # getting the logs based on the date
                foreach($log_dates as $d) {
                    
                    $temp = [];

                    # Gets the logs 
                    foreach($logs as $log) {
                        if($log->log_date == $d) {
                            array_push($temp, $log);
                        }
                    }

                    # Computation of total time each day
                    $am_total = 0; 
                    $pm_total = 0;

                    if($temp[0]->time == null || $temp[1]->time == null) {
                        $am_total = 0;
                    } else {
                        $am_login = new \DateTime( $temp[0]->time );
                        $am_logout = new \DateTime( $temp[1]->time );    
                        $am_total = $am_login->diff($am_logout);
                        $am_total = $am_total->format("%H.%i");
                    }

                    if($temp[2]->time == null || $temp[3]->time == null) {
                        $pm_total = 0;
                    } else {
                        $pm_login =  new \DateTime( $temp[2]->time );
                        $pm_logout =  new \DateTime( $temp[3]->time );
                        $pm_total = $pm_login->diff($pm_logout);
                        $pm_total = $pm_total->format("%H.%i");
                    }

                    $time_total = floatval( $am_total + $pm_total );
                    array_push($time_totals, $time_total);
                    # echo "LOGIN DATE :". $d . " - ". $time_total ."<br>";
                }

                # Getting of total working time
                $holder['twh'] = array_sum($time_totals);

                array_push($output, $holder);
                
            }
        
        }

        # echo json_encode($output);
        
        # exit();

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', $date);   
        
        $this->set(compact('user'));
        $this->set(compact('page'));
        $this->set(compact('payroll'));
        $this->set(compact('date'));
        $this->set(compact('output'));
        $this->set(compact('seconds'));
        # $this->set(compact('data'));
    }

    public function filterArray($value) {
        echo "Here";
    }

    public function getUserData($id) {
        $user = $this->Users->find()
                ->where(['id' => $id])
                ->first();

        return $user;
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {


        $payroll = $this->Payrolls->newEntity();

        if($this->request->is('post')) {

            $payroll->bill_date = $this->request->getData('bill_date');
            $payroll->start_date = $this->request->getData('start_date');
            $payroll->end_date = $this->request->getData('end_date');

            $payroll->is_thirteen_month_pay = false;

            $is_thirtheen_month_pay = $this->request->getData('is_thirteen_month_pay');

            if($is_thirtheen_month_pay != null && $is_thirtheen_month_pay != '' && $is_thirtheen_month_pay == 'true') {
                $payroll->is_thirteen_month_pay = true;    
            }
            
            
            $file = $this->request->data['payroll_file'];
            $file['name'] = time() . '-' . str_replace(' ', '_', $file['name']);

            # echo $payroll->id;
            
            # $this->saveLogsToDatabase($file['name']);

            if (move_uploaded_file($file['tmp_name'], WWW_ROOT . 'files/' . $file['name'])) {
                # echo "Uploaded!";
                $payroll->file = $file['name'];

                $result = $this->Payrolls->save($payroll);

                if($result) {

                    // debug($result);
                    $this->saveLogsToDatabase( $file['name'], $result->id );
                    echo "SUCCESS IN ADDING!";
                    return $this->redirect($this->referer());
                    // return $this->redirect(['controller' => 'Payroll','action' => 'view', strtotime($payroll->bill_date) * 1000]);
                }
                

                // TODO : Add the file name to the database. 
            }

            // echo $this->request->getData('payroll_file');
            // debug($payroll);
            
        }

        exit();
        // if ($this->request->is('post')) {
        //     $payroll = $this->Payrolls->patchEntity($payroll, $this->request->getData());
        //     if ($this->Payrolls->save($payroll)) {
        //         $this->Flash->success(__('The payroll has been saved.'));

        //         return $this->redirect(['action' => 'index']);
        //     }
        //     $this->Flash->error(__('The payroll could not be saved. Please, try again.'));
        // }
        // $this->set(compact('payroll'));
    }

    public function saveLogsToDatabase( $filename, $id ) {

        # Reading the file contents
        $lines = file(WWW_ROOT.'/files/'.$filename);
        
        array_shift($lines);
        
        $logs = $this->extractLines($lines);

        # Save to database
        try {
            foreach($logs as $log) {
            
                $log_item = $this->Logs->newEntity();
    
                $new_log = [
                    "user_id" => $log["employee_id"],
                    "log_date" => $log["log_date"], 
                    "time" => $log["time"],
                    "payroll_id" => $id
                ];
    
                $log_item = $this->Logs->patchEntity($log_item, $new_log);
                $this->Logs->save($log_item);
            }       
        } catch (\Throwable $th) {
           echo "Error!";
        }

    }

    public function extractLines($lines) {
        $result = [];

        # Extracting the data from the file
        foreach($lines as $line) {
            $temp = preg_split('/\s+/', $line);
            
            $holder = [
                        "id" => $temp[0],
                        "employee_id" => $temp[2],
                        "log_date" => $temp[7],
                        "time" => $temp[8]
                        ];

            array_push($result, $holder);
        }

        return $result;
    }



    public function edit($id = null)
    {
        $payroll = $this->Payrolls->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payroll = $this->Payrolls->patchEntity($payroll, $this->request->getData());
            if ($this->Payrolls->save($payroll)) {
                $this->Flash->success(__('The payroll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payroll could not be saved. Please, try again.'));
        }
        $this->set(compact('payroll'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $payroll = $this->Payrolls->get($id);
        if ($this->Payrolls->delete($payroll)) {
            $this->Flash->success(__('The payroll has been deleted.'));
        } else {
            $this->Flash->error(__('The payroll could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function list() {
        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', 'List');   
        $records = $this->Payrolls->find() 
                   ->order(['id' => 'desc'])
                   ->toList();

        $this->set(compact('user'));
        $this->set(compact('records'));
        $this->set(compact('page'));
    }

    public function setPageVariables($title, $subtitle) {
        return [
            "title" =>  $title,
            "sub_title" => $subtitle
        ];
    }

    public function generate($seconds = null) {

        $this->RequestHandler->respondAs('pdf', [
            // Force download
            'attachment' => true,
            'charset' => 'UTF-8'
        ]);

    
        // $seconds = $mil / 1000;
        $date = date("Y-m-d", $seconds);

        $payroll = $this->Payrolls->find() 
                   ->where(['bill_date' => $date])
                   ->contain(['logs'])
                   ->first();

        $data = [];

        $output = [];

        if($payroll != null) {
            
            $user_ids = [];
            $user_logs = $payroll->logs;
           

            # Getting of unique user_id
            foreach ($user_logs as $log) {
                if( !in_array($log->user_id, $user_ids) ) { 
                    array_push($user_ids, $log->user_id);
                }
            }

            foreach($user_ids as $id) {
                $user_log = [];
                foreach ($user_logs as $log) {
                    if($log->user_id == $id) {
                        array_push($user_log, $log);
                    }                    
                }
                
                array_push($data, ["user_id" => $id, "logs" => $user_log ,"user" => $this->getUserData($id),"twh" => 0]);
            }    

            foreach($data as $item) {
                
                $log_dates = [];
                $logs = $item['logs'];
                
                $holder = ["user_id" => $item['user_id'], "logs" =>  $item['logs'], "user" => $item["user"], "twh" => 0]; 
        
                $time_totals = [];

                # getting of log dates of the user
                foreach($logs as $log) {
                    if( !in_array($log->log_date, $log_dates) ) { 
                        array_push($log_dates, $log->log_date);
                    }
                }
                
                # getting the logs based on the date
                foreach($log_dates as $d) {
                    
                    $temp = [];

                    # Gets the logs 
                    foreach($logs as $log) {
                        if($log->log_date == $d) {
                            array_push($temp, $log);
                        }
                    }

                    # Computation of total time each day
                    $am_total = 0; 
                    $pm_total = 0;

                    if($temp[0]->time == null || $temp[1]->time == null) {
                        $am_total = 0;
                    } else {
                        $am_login = new \DateTime( $temp[0]->time );
                        $am_logout = new \DateTime( $temp[1]->time );    
                        $am_total = $am_login->diff($am_logout);
                        $am_total = $am_total->format("%H.%i");
                    }

                    if($temp[2]->time == null || $temp[3]->time == null) {
                        $pm_total = 0;
                    } else {
                        $pm_login =  new \DateTime( $temp[2]->time );
                        $pm_logout =  new \DateTime( $temp[3]->time );
                        $pm_total = $pm_login->diff($pm_logout);
                        $pm_total = $pm_total->format("%H.%i");
                    }

                    $time_total = floatval( $am_total + $pm_total );
                    array_push($time_totals, $time_total);
                    # echo "LOGIN DATE :". $d . " - ". $time_total ."<br>";
                }

                # Getting of total working time
                $holder['twh'] = array_sum($time_totals);

                array_push($output, $holder);
                # debug($log_dates);
            }
        }

        $this->set(compact('payroll'));
        $this->set(compact('date'));
        $this->set(compact('output'));
        // $this->set(compact('seconds'));
    }

    public function logs($user_id, $seconds) {
        
        # $seconds = $mil / 1000;
        $date = date("Y-m-d", $seconds);

        $payroll = $this->Payrolls->find() 
                   ->where(['bill_date' => $date])
                   ->contain(['logs'])
                   ->first();

        $employee = $this->Users->find() 
                    ->where(['id' => $user_id])
                    ->first();

        $logs = $payroll->logs;

        $user_logs = [];
        $unique_dates = [];
        foreach($logs as $log) {
            if($log->user_id == $user_id) {
                array_push($user_logs, $log);
            }
        }

        foreach($user_logs as $log) {
            if(!in_array($log->log_date, $unique_dates)) {
                array_push($unique_dates, $log->log_date);
            }
        }

        $data = [];

        foreach($unique_dates as $date) {
            $temp = [
                    "date" => "",
                    "logs" => []
                    ];

            $logs = [];
            
            # Getting all the time of such log date
            foreach($user_logs as $log) {
                if($log->log_date == $date) {
                    array_push($logs, $log->time);
                }
            }

            // $temp['date' => $date, 'logs' => $temp];
            $temp["date"] = $date;
            $temp["logs"] = $logs;

            array_push($data,$temp);
        }

        // debug($data);

        // debug($unique_dates);
        
        // exit();
        

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', $date);   
    
        $this->set(compact('user'));
        $this->set(compact('employee'));
        $this->set(compact('page'));
        $this->set(compact('payroll'));
        $this->set(compact('date'));

        $this->set(compact('data'));
        // $this->set(compact('output'));
        $this->set(compact('seconds'));
        
    }

    public function printLogs($user_id, $seconds) {

        $this->RequestHandler->respondAs('pdf', [
            // Force download
            'attachment' => true,
            'charset' => 'UTF-8'
        ]);

        $date = date("Y-m-d", $seconds);

        $payroll = $this->Payrolls->find() 
                   ->where(['bill_date' => $date])
                   ->contain(['logs'])
                   ->first();

        $employee = $this->Users->find() 
                    ->where(['id' => $user_id])
                    ->first();

        $logs = $payroll->logs;

        $user_logs = [];
        $unique_dates = [];
        foreach($logs as $log) {
            if($log->user_id == $user_id) {
                array_push($user_logs, $log);
            }
        }

        foreach($user_logs as $log) {
            if(!in_array($log->log_date, $unique_dates)) {
                array_push($unique_dates, $log->log_date);
            }
        }

        $data = [];

        foreach($unique_dates as $date) {
            $temp = [
                    "date" => "",
                    "logs" => []
                    ];

            $logs = [];
            
            # Getting all the time of such log date
            foreach($user_logs as $log) {
                if($log->log_date == $date) {
                    array_push($logs, $log->time);
                }
            }

            // $temp['date' => $date, 'logs' => $temp];
            $temp["date"] = $date;
            $temp["logs"] = $logs;

            array_push($data,$temp);
        }

        // debug($data);

        // debug($unique_dates);
        
        // exit();
        

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', $date);   
    
        $this->set(compact('user'));
        $this->set(compact('employee'));
        $this->set(compact('page'));
        $this->set(compact('payroll'));
        $this->set(compact('date'));

        $this->set(compact('data'));
        // $this->set(compact('output'));
        $this->set(compact('seconds'));        
    }
}
