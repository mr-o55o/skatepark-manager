<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;

/**
 * PurchasedLessonEditionsBundle Entity
 *
 * @property int $id
 * @property int $athlete_id
 * @property int $lesson_editions_bundle_id
 * @property bool $is_active
 * @property \Cake\I18n\FrozenTime $start_date
 * @property \Cake\I18n\FrozenTime $end_date
 *
 * @property \App\Model\Entity\Athlete $athlete
 * @property \App\Model\Entity\LessonEditionsBundle $lesson_editions_bundle
 */
class PurchasedLessonEditionsBundle extends Entity
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
        'lesson_editions_bundle_id' => true,
        'start_date' => true,
        'end_date' => true,
        'athlete' => true,
        'lesson_editions_bundle' => true,
        'status' => true
    ];

    //bundle is valid if is activated, his end date is not passed yet
    public function isValid() {
        $now = Time::now();
        if ($this->status <= 2 ) {
            return true;
        }
        return false;
    }
}
