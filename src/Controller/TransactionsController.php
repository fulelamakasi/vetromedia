<?php
namespace App\Controller;

use App\Controller\AppController;

class TransactionsController extends AppController
{
    public function index(){
        $this->paginate = [
            'contain' => ['Users']
        ];
//        $transactions = $this->Transactions->find('all')->where(['user_id' => $this->Auth->id]);

        $this->set(compact('transactions'));
        $this->set('_serialize', ['transactions']);
    }

    public function view($id = null){
        if(!$this->_setCheckUser($id)){
            $this->Flash->error(__('You\'re trying to view a transaction that does not belong to you.'));
            return $this->redirect(['action' => 'index']);            
        }

        $transaction = $this->Transactions->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('transaction', $transaction);
        $this->set('_serialize', ['transaction']);
    }

    public function add(){
        $transaction = $this->Transactions->newEntity();
        if ($this->request->is('post')) {
            $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
            if ($this->Transactions->save($transaction)) {
                $this->Flash->success(__('The transaction has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
        }
        $users = $this->Transactions->Users->find('list', ['limit' => 200]);
        $this->set(compact('transaction', 'users'));
        $this->set('_serialize', ['transaction']);
    }

    public function edit($id = null){
        $transaction = $this->Transactions->get($id);
        $this->Flash->error(__('To prevent fraudulent acts this functionality has been disabled please contact supervisor or development.'));

        return $this->redirect(['action' => 'view', $transaction->user_id]);
    }

    public function delete($id = null){
        $transaction = $this->Transactions->get($id);
        $this->Flash->error(__('To prevent fraudulent acts this functionality has been disabled please contact supervisor or development.'));

        return $this->redirect(['action' => 'view', $transaction->user_id]);
    }

    private function _setCheckUser($id = null){
        $transaction = $this->Transactions->get($id);

        if($transaction->user_id == $this->Auth->id){
            return true;
        }

        return false;
    }    
}

/* Old Edit & Delete
public function edit($id = null){
    $transaction = $this->Transactions->get($id, [
        'contain' => []
    ]);
    if ($this->request->is(['patch', 'post', 'put'])) {
        $transaction = $this->Transactions->patchEntity($transaction, $this->request->getData());
        if ($this->Transactions->save($transaction)) {
            $this->Flash->success(__('The transaction has been saved.'));

            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The transaction could not be saved. Please, try again.'));
    }
    $users = $this->Transactions->Users->find('list', ['limit' => 200]);
    $this->set(compact('transaction', 'users'));
    $this->set('_serialize', ['transaction']);
}
public function delete($id = null){
    $this->request->allowMethod(['post', 'delete']);
    $transaction = $this->Transactions->get($id);
    if ($this->Transactions->delete($transaction)) {
        $this->Flash->success(__('The transaction has been deleted.'));
    } else {
        $this->Flash->error(__('The transaction could not be deleted. Please, try again.'));
    }

    return $this->redirect(['action' => 'index']);
}*/