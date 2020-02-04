<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ResponsiblePerson Entity
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $fiscal_code
 *
 * @property \App\Model\Entity\Athlete[] $athletes
 */
class ResponsiblePerson extends Entity
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
        'surname' => true,
        'email' => true,
        'phone' => true,
        'fiscal_code' => true,
        'athletes' => true,
        'birth_date' => true,
        'birth_city' => true,
        'birth_province_code' => true,
        'address' => true,
        'city' => true,
        'province_code' => true,
        'postal_code' => true,
    ];
}
