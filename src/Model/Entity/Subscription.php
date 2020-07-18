<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subscription Entity
 *
 * @property int $id
 * @property int $athlete_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $is_paid
 * @property \Cake\I18n\FrozenDate $start_date
 * @property \Cake\I18n\FrozenDate $end_date
 * @property int $subscription_status_id
 * @property int $subscription_type_id
 *
 * @property \App\Model\Entity\Athlete $athlete
 * @property \App\Model\Entity\SubscriptionStatus $subscription_status
 * @property \App\Model\Entity\SubscriptionType $subscription_type
 * @property \App\Model\Entity\SelectedCourseEdition[] $selected_course_editions
 */
class Subscription extends Entity
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
        'athlete_id' => true,
        'created' => true,
        'modified' => true,
        'is_paid' => true,
        'start_date' => true,
        'end_date' => true,
        'subscription_status_id' => true,
        'subscription_type_id' => true,
        'athlete' => true,
        'subscription_status' => true,
        'subscription_type' => true,
        'selected_course_editions' => true
    ];
}
