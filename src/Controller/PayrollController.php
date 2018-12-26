<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Payroll Controller
 *  
 *
 * @method \App\Model\Entity\Payroll[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PayrollController extends AppController
{
    public function initialize()
    { 
        parent::initialize();
        # $this->Auth->allow(['logout','add','signup']);
    }

    public function beforeRender(Event $event) {
        $this->viewBuilder()->setLayout('main');
    }

    public function index()
    {
        # $this->viewBuilder()->setLayout('main');

        // $payroll = $this->paginate($this->Payroll);

        // $this->set(compact('payroll'));
    }

    /** 
     * View method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $payroll = $this->Payroll->get($id, [
            'contain' => []
        ]);

        $this->set('payroll', $payroll);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $payroll = $this->Payroll->newEntity();
        if ($this->request->is('post')) {
            $payroll = $this->Payroll->patchEntity($payroll, $this->request->getData());

            # $payroll->is_thirteen_month_pay = $this->request->getData('is_thirteen_month_pay');
            
            if ($this->Payroll->save($payroll)) {
                $this->Flash->success(__('The payroll has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payroll could not be saved. Please, try again.'));
        }
        $this->set(compact('payroll'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Payroll id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $payroll = $this->Payroll->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $payroll = $this->Payroll->patchEntity($payroll, $this->request->getData());
            if ($this->Payroll->save($payroll)) {
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
        $payroll = $this->Payroll->get($id);
        if ($this->Payroll->delete($payroll)) {
            $this->Flash->success(__('The payroll has been deleted.'));
        } else {
            $this->Flash->error(__('The payroll could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
