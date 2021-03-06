<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\ORM\TableRegistry;

/**
 * Transactions Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Transaction get($primaryKey, $options = [])
 * @method \App\Model\Entity\Transaction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Transaction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Transaction|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Transaction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Transaction findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TransactionsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('transactions');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'joinType' => 'INNER'
        ]);

        $this->belongsTo('Countries', [
            'foreignKey' => 'currency_from',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('original_price')
            ->allowEmpty('original_price');

        $validator
            ->decimal('converted_price')
            ->allowEmpty('converted_price');

        $validator
            ->decimal('surge')
            ->allowEmpty('surge');

        $validator
            ->decimal('surge_amount')
            ->allowEmpty('surge_amount');

        $validator
            ->decimal('currency_to_exchangerate')
            ->allowEmpty('currency_to_exchangerate');

        $validator
            ->integer('currency_from')
            ->requirePresence('currency_from', 'create')
            ->notEmpty('currency_from');

        $validator
            ->integer('currency_to')
            ->requirePresence('currency_to', 'create')
            ->notEmpty('currency_to');

        $validator
            ->allowEmpty('editedby');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'));

        return $rules;
    }

    public function setTransaction(array $data){
        $transactions = TableRegistry::get('Transactions');
        $transaction = $transactions->newEntity();
        $transactions->patchEntity($transaction, $data);

        $transaction = $transactions->save($transaction);

        return $transaction;
    }

    public function setTransactions(array $fields, array $conditions){
        $transactions = TableRegistry::get('Transactions');

        $transactions->updateAll($fields, $conditions);

        return true;
    }

    public function getTransaction(array $condition){
        $transactions = TableRegistry::get('Transactions');
        
        $transaction = $transactions->find('all')
                                        ->where($condition)
                                        ->toArray();

        return $transaction;
    }
}
