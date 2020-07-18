<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * SelectedCourseEdition Entity
 *
 * @property int $id
 * @property int $course_subscription_id
 * @property int $course_edition_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CourseSubscription $course_subscription
 * @property \App\Model\Entity\CourseEdition $course_edition
 */
class SelectedCourseEdition extends Entity
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
        'course_subscription_id' => true,
        'course_edition_id' => true,
        'created' => true,
        'modified' => true,
        'course_subscription' => true,
        'course_edition' => true
    ];
}
