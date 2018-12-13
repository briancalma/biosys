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

        # $mil = 1227643821310;
        $seconds = $mil / 1000;
        $date = date("Y-m-d", $seconds);

        $payroll = $this->Payrolls->find() 
                   ->where(['bill_date' => $date])
                   ->first();

        # debug($payroll);

        // exit();

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Payroll', $date);   
        
        $this->set(compact('user'));
        $this->set(compact('page'));
        $this->set(compact('payroll'));
        $this->set(compact('date'));
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

    public function setPageVariables($title, $subtitle) {
        return [
            "title" =>  $title,
            "sub_title" => $subtitle
        ];
    }
}
