<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * LessonEditionsCalculation Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property string $notes
 */
class LessonEditionsCalculation extends Entity
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
        'created' => true,
        'notes' => true,
        'amount_in' => true,
        'amount_out' => true,
        'lesson_editions_counted' => true
    ];
}
