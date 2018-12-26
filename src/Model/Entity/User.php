<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
/**
 * User Entity
 *
 * @property int $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $firstname
 * @property string $lastname
 * @property string|null $gender
 * @property string|null $address
 * @property string|null $profile_pic
 * @property string $account_type
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $age
 * @property string $birthdate
 * @property string $department
 * @property string $position
 * @property float $rate_per_hour
 * @property bool $philhealth
 * @property bool $sss
 * @property bool $pagibig
 *
 * @property \App\Model\Entity\Log[] $logs
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
        'email' => true,
        'username' => true,
        'password' => true,
        'firstname' => true,
        'lastname' => true,
        'gender' => true,
        'address' => true,
        'profile_pic' => true,
        'account_type' => true,
        'created' => true,
        'modified' => true,
        'age' => true,
        'birthdate' => true,
        'department' => true,
        'position' => true,
        'rate_per_hour' => true,
        'philhealth' => true,
        'sss' => true,
        'pagibig' => true,
        'logs' => true
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }
}
