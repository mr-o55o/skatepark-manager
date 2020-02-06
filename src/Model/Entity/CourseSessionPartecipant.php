<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseSessionPartecipant Entity
 *
 * @property int $id
 * @property int $course_session_id
 * @property int $athlete_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CourseSession $course_session
 * @property \App\Model\Entity\Athlete $athlete
 */
class CourseSessionPartecipant extends Entity
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
        'athlete_id' => true,
        'created' => true,
        'modified' => true,
        'course_session' => true,
        'athlete' => true,
        'rent_skateboard' => true,
        'rent_helmet' => true,
        'rent_pads' => true,
        'is_present' => true,
    ];
}
