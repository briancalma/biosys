<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    public function initialize()
    { 
        parent::initialize();
        $this->loadModel('Logs');
        # $this->Auth->allow(['logout','add','signup']);
    }
    
    public function beforeRender(Event $event) {
       
    }


    public function index()
    {   
        $this->viewBuilder()->setLayout('main');

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Management', 'Employee List');   
        $employees = $this->Users->find()
                    ->where(['account_type' => 'employee'])
                    ->order(['id' => 'desc'])
                    ->all();


        $this->set(compact('user'));
        $this->set(compact('employees'));
        $this->set(compact('page'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Logs']
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {   
        $this->viewBuilder()->setLayout('main');

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Management', 'Add New Employee');   


        $new_user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $new_user = $this->Users->patchEntity($new_user, $this->request->getData());

            $new_user->username = $this->request->getData('firstname').$this->request->getData('lastname');
            $new_user->password = 'cgeek2019';
            $new_user->rate_per_hour = $this->request->getData('rate');


            $new_user->account_type = 'employee';
            $new_user->sss = false;
            $new_user->pagibig = false;
            $new_user->philhealth = false;

            foreach ($this->request->getData('benefits') as $benefit) {
                if($benefit == 'sss') $new_user->sss = true;
                if($benefit == 'pagibig') $new_user->pagibig = true;
                if($benefit == 'philhealth') $new_user->philhealth = true;
            }

            // debug($this->request->getData());

            // debug($new_user);

            // exit();
            
            if ($this->Users->save($new_user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        //$this->set(compact('newuser'));

        $this->set(compact('user'));
        $this->set(compact('page'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        $this->viewBuilder()->setLayout('main');

        $user = $this->Auth->user();
        $page = $this->setPageVariables('Management', 'Edit Employee Record');   

        $account = $this->Users->get($id, [
            'contain' => []
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $account = $this->Users->patchEntity($account, $this->request->getData());
            if ($this->Users->save($account)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->set(compact('account'));
        $this->set(compact('user'));
        $this->set(compact('page'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login() {
        $this->viewBuilder()->setLayout('login');

        if($this->request->is('post')) {
            $user = $this->Auth->identify();
            if($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }

            $this->Flash->error('Your username or password is incorrect.');
        }
    }

    public function logout() {
        $this->Flash->success('You are now logged out.');
        return $this->redirect($this->Auth->logout());
    }

    public function signup() {
        $this->viewBuilder()->setLayout('login');

        $user = $this->Users->newEntity();
        if($this->request->is('post'))
        {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if($this->Users->save($user)) 
            {  
                $this->Flash->success(__('Your are successfully created a new account!'));
                return $this->redirect('users/');
            }
            $this->Flash->error(__('Error in creating new account!'));
        }
    }

    public function isAuthorized($user)
    {
        // By default deny access.
        return true;
    }  

    public function setPageVariables($title, $subtitle) {
        return [
            "title" =>  $title,
            "sub_title" => $subtitle
        ];
    }
}
