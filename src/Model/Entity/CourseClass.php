<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CourseClass Entity
 *
 * @property string $name
 * @property int $course_period_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $course_edition_id
 * @property int $course_class_status_id
 * @property int $id
 *
 * @property \App\Model\Entity\CoursePeriod $course_period
 * @property \App\Model\Entity\CourseEdition $course_edition
 * @property \App\Model\Entity\CourseClassStatus $course_class_status
 * @property \App\Model\Entity\CourseClassMember[] $course_class_members
 */
class CourseClass extends Entity
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
        'course_period_id' => true,
        'created' => true,
        'modified' => true,
        'course_id' => true,
        'course' => true,
        'course_class_status' => true,
    ];
}
