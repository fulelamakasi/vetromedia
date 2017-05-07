<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransactionsFixture
 *
 */
class TransactionsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'original_price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'converted_price' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'surge' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'surge_amount' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'currency_to_exchangerate' => ['type' => 'decimal', 'length' => 10, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'currency_from' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'currency_to' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'user_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'editedby' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'fk_transactions_users_idx' => ['type' => 'index', 'columns' => ['user_id'], 'length' => []],
            'fk_transactions_currencyfrom_idx' => ['type' => 'index', 'columns' => ['currency_from'], 'length' => []],
            'fk_transactions_currencyto_idx' => ['type' => 'index', 'columns' => ['currency_to'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_transactions_currencyfrom' => ['type' => 'foreign', 'columns' => ['currency_from'], 'references' => ['countries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_transactions_currencyto' => ['type' => 'foreign', 'columns' => ['currency_to'], 'references' => ['countries', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_transactions_users' => ['type' => 'foreign', 'columns' => ['user_id'], 'references' => ['users', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'original_price' => 1.5,
            'converted_price' => 1.5,
            'surge' => 1.5,
            'surge_amount' => 1.5,
            'currency_to_exchangerate' => 1.5,
            'currency_from' => 1,
            'currency_to' => 1,
            'user_id' => 1,
            'created' => '2017-05-07 12:04:44',
            'modified' => 1494158684,
            'editedby' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
