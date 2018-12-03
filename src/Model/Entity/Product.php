<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property string $location
 * @property int $sale_percent
 * @property float|null $sale_price
 * @property string|null $details
 * @property string|null $description
 * @property string|null $picture
 * @property int $category_id
 * @property int $user_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $max_availability_date
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Category $category
 * @property \App\Model\Entity\User $user
 */
class Product extends Entity
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
        'name' => true,
        'price' => true,
        'location' => true,
        'sale_percent' => true,
        'sale_price' => true,
        'details' => true,
        'description' => true,
        'picture' => true,
        'category_id' => true,
        'user_id' => true,
        'created' => true,
        'max_availability_date' => true,
        'modified' => true,
        'category' => true,
        'user' => true
    ];
}
