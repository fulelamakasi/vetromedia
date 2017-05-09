<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

class UsersController extends AppController
{
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Auth->allow(['login', 'add', 'logout']);
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Countries']
        ];
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Countries']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    public function add(){
        $user = $this->Users->newEntity();

        if ($this->request->is('post')) {
            if(!$this->_setVerifyPassword()){
                $this->Flash->error(__('The passwords do not match. Please, try again.'));
                return $this->redirect(['action' => 'add']);
            }

            if($this->_getSimilarExistingUsername()){
                $this->Flash->error(__('The username "'. $this->request->data['username'] .'" already exists on our system. Please, try again.'));
                return $this->redirect(['action' => 'add']);
            }

            if($this->_getSimilarExistingEmail()){
                $this->Flash->error(__('The email address "'. $this->request->data['emailadress'] .'" already exists on our system. Please, try again.'));
                return $this->redirect(['action' => 'add']);
            }

            $this->request->data['editedby'] = $this->request->data['username'];
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'countries'));
        $this->set('_serialize', ['user']);
    }

    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->request->data['editedby'] = $this->request->data['username'];
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'countries'));
        $this->set('_serialize', ['user']);
    }

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

    public function forgot(){

        return $this->redirect(['action' => 'login']);
    }

    public function reset(){
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!$this->_setVerifyPassword()){
                $this->Flash->error(__('The passwords do not match. Please, try again.'));
                return $this->redirect(['action' => 'reset']);
            }
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password for '. $user->username .' has been update.'));

                return $this->redirect(['action' => 'login']);
            }
            $this->Flash->error(__('The password could not be saved. Please, try again.'));
        }
    }

    public function login(){
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout(){
        return $this->redirect($this->Auth->logout());
        //return $this->redirect(['action' => 'login']);
    }

    private function _setVerifyPassword(){
        if(strcasecmp($this->request->getData('password'), $this->request->getData('confirm_password')) == 0){
            return true;
        }

        return false;
    }

    public function setPassword($id = null){
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            if(!$this->_setVerifyPassword()){
                $this->Flash->error(__('The passwords do not match. Please, try again.'));
                return $this->redirect(['action' => 'setPassword']);
            }
            
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The password for '. $user->username .' has been update.'));

                return $this->redirect(['action' => 'view', $id]);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $countries = $this->Users->Countries->find('list', ['limit' => 200]);
        $this->set(compact('user', 'countries'));
        $this->set('_serialize', ['user']);
    }

    private function _getSimilarExistingEmail(){
        $users = $this->Users->find('all')
                                ->where(['emailaddress' => $this->request->getData('emailaddress')])
                                ->toArray();
        if(!empty($users)){
            return true;
        }

        return false;
    }

    private function _getSimilarExistingUsername(){
        $users = $this->Users->find('all')
                                ->where(['username' => $this->request->getData('username')])
                                ->toArray();
        if(!empty($users)){
            return true;
        }

        return false;
    }        
}
