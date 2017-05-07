<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transaction Entity
 *
 * @property int $id
 * @property float $original_price
 * @property float $converted_price
 * @property float $surge
 * @property float $surge_amount
 * @property float $currency_to_exchangerate
 * @property int $currency_from
 * @property int $currency_to
 * @property int $user_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $editedby
 *
 * @property \App\Model\Entity\User $user
 */
class Transaction extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
