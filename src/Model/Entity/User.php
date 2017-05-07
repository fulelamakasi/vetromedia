<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $emailaddress
 * @property string $phonenumber
 * @property bool $is_emailverified
 * @property int $country_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property string $editedby
 *
 * @property \App\Model\Entity\Country $country
 */
class User extends Entity
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
