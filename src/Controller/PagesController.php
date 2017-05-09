<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;
use Cake\Network\Http\Client;
use Cake\Event\Event;

class PagesController extends AppController
{
    public $countries = NULL;
    public $transactions = NULL;
    public $users = NULL;

    public function initialize(){
        $this->countries = TableRegistry::get('Countries');
        $this->transactions = TableRegistry::get('Transactions');
        $this->users = TableRegistry::get('Users');
    }

    public function beforeFilter(Event $event){
        parent::beforeFilter($event);
        $this->Auth->allow(['compareratesnoneuser']);
    }
    

    public function display(...$path){
        $count = count($path);
        if (!$count) {
            return $this->redirect('/');
        }
        if (in_array('..', $path, true) || in_array('.', $path, true)) {
            throw new ForbiddenException();
        }
        $page = $subpage = null;

        if (!empty($path[0])) {
            $page = $path[0];
        }
        if (!empty($path[1])) {
            $subpage = $path[1];
        }
        $this->set(compact('page', 'subpage'));

        try {
            $this->render(implode('/', $path));
        } catch (MissingTemplateException $e) {
            if (Configure::read('debug')) {
                throw $e;
            }
            throw new NotFoundException();
        }
    }
//http://apilayer.net/api/list?access_key=1a0d14517d102c63014a66a5485a8b0f&format=1 supported formats
    private function _setPostData(){
        $http = new Client();
        $response = $http->get('http://www.apilayer.net/api/live?access_key=1a0d14517d102c63014a66a5485a8b0f&format=1');
        $responseBody = json_decode($response->body);
        
        if($responseBody->success){
            //return usd convert usd to 
            debug($responseBody); die();
        }
    }

    public function convertCurrency(){
        if ($this->request->is('post')) {
            if($this->_setCheckCountries()){
                $this->Flash->error(__('The selected countries match. Please, try again.'));
                return $this->redirect(['action' => 'convertCurrency']);
            }
            
            $transaction = $this->_setTransaction();

            if($this->request->data['countryto'] == 2){
               if(!$this->_setSendEmail($this->Auth->user('id'), $transaction->id)){
                    $this->Flash->error(__('Could not process your email. Please, try again.'));
                    return $this->redirect(['action' => 'convertCurrency']);
               }
            }

            $country = $this->countries->getCountry(['id' => $transaction->currency_to]);

            if(strcasecmp($country['currency_code'], 'EUR') == 0){
                $this->_setDiscount($transaction->id);
                    $this->Flash->success(__('Your order was a success, would you like to order more.'));
                    return $this->redirect(['controller' => 'Transactions', 'action' => 'view', $transaction->id]);
            }
        }

        $countryfrom = $this->countries->find('list', ['limit' => 200]);
        $countryto = $this->countries->find('list', ['limit' => 200]);
        $this->set('countryfrom', $countryfrom);
        $this->set('countryto', $countryto);
    }

    public function compareratesnoneuser(){
        if ($this->request->is('post')){
            $this->_setPostData();
            if($this->_setCheckCountries()){
                $this->Flash->error(__('The selected countries match. Please, try again.'));
                return $this->redirect(['action' => 'compareratesnoneuser']);
            }

        }

        $countryfrom = $this->countries->find('list', ['limit' => 200]);
        $countryto = $this->countries->find('list', ['limit' => 200]);
        $this->set('countryfrom', $countryfrom);
        $this->set('countryto', $countryto);
    }

    private function _setCheckCountries(){
        if($this->request->getData('countryfrom') == $this->request->getData('countryto')){
            return true;
        }

        return false;
    }

    private function _setTransaction(){
        
        return $this->transactions->setTransaction($this->request->data);
    }

    private function _setSurge(){
        
    }

    private function _setSendEmail($user_id = null, $transaction_id = null){
        if($user_id != null && $transaction_id != null){
            $user = $this->users->getUser(['id' => $user_id]);
            $transaction = $this->transactions->getTransaction(['id' => $transaction_id]);
            $countryfrom = $this->countries->getCountry(['id' => $transaction['country_from']]);
            $countryto = $this->countries->getCountry(['id' => $transaction['country_to']]);
            $message = 'Order #'. $transaction['id'] ."\n
                            Original Price: ". $transaction['original_price'] ."\n 
                            Converted Price: ". $transaction['converted_price'] ."\n
                            Transaction Date: ". $transaction['created'] ."\n
                            Surge Amount: ". $transaction['surge_amount'] ."\n
                            Country From: ". $countryfrom['name'] ."\n
                            Country To: ". $countryto['name'] ."\n \n \r
                            Kind Regards.";
            $email = new Email();
            $email->from(['fulela@awesometeam.com' => 'awesometeam.com']);
            $email->to($user['emailaddress']);
            $email->subject('Order details for #'. $transaction['id']);
            $email->send($message);
            return true;
        }
        return false;
    }

    private function _setDiscount($transaction_id = NULL){
        $transaction = $this->transactions->getTransaction(['id' => $transaction_id]);

        $discount = $transaction['converted_price'] * 0.02;

        $fields = [
                    'converted_price' => $transaction['converted_price'] - $discount,
        ];

        $conditions = [
                        'currency_code' => 'EUR',
        ];

        $this->transactions->setTransactions($fields, $conditions);

        return true;
    }

    private function _getJsonRates(){
//call me to get json rates post rates http://www.apilayer.net/api/live?access_key=1a0d14517d102c63014a66a5485a8b0f&format=1
    }
}
