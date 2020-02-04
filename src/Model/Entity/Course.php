<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $name
 * @property int $course_level_id
 * @property string $week_days
 * @property \Cake\I18n\FrozenTime $start_time
 * @property int $duration
 * @property float $price
 * @property int $course_status_id
 *
 * @property \App\Model\Entity\CourseLevel $course_level
 * @property \App\Model\Entity\CourseStatus $course_status
 * @property \App\Model\Entity\CourseSession[] $course_sessions
 */
class Course extends Entity
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
        'modified' => true,
        'name' => true,
        'course_level_id' => true,
        'week_days' => true,
        'start_time' => true,
        'duration' => true,
        'price' => true,
        'course_status_id' => true,
        'course_level' => true,
        'course_status' => true,
        'course_sessions' => true,
        'start_date' => true,
        'end_date' => true
    ];
}
