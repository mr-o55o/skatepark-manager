<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseSession Entity
 *
 * @property int $id
 * @property int $course_status_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $event_id
 * @property int $course_id
 *
 * @property \App\Model\Entity\CourseStatus $course_status
 * @property \App\Model\Entity\Event $event
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\CourseSessionPartecipant[] $course_session_partecipants
 */
class CourseSession extends Entity
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
        'course_session_status_id' => true,
        'created' => true,
        'modified' => true,
        'event_id' => true,
        'course_id' => true,
        'course_session_status' => true,
        'event' => true,
        'course' => true,
        'course_session_partecipants' => true
    ];
}
