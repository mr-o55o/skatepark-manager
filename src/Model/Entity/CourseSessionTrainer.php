<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseSessionTrainer Entity
 *
 * @property int $id
 * @property int $course_session_id
 * @property int $user_id
 * @property string $notes
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CourseSession $course_session
 * @property \App\Model\Entity\User $user
 */
class CourseSessionTrainer extends Entity
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
        'course_session_id' => true,
        'user_id' => true,
        'notes' => true,
        'created' => true,
        'modified' => true,
        'course_session' => true,
        'user' => true
    ];
}
