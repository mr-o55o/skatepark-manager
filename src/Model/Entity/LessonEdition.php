<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
/**
 * LessonEdition Entity
 *
 * @property int $id
 * @property int $lesson_id
 * @property \Cake\I18n\FrozenTime $start_date
 * @property int $lesson_status_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $ahtlete_id
 *
 * @property \App\Model\Entity\Lesson $lesson
 * @property \App\Model\Entity\LessonStatus $lesson_status
 * @property \App\Model\Entity\Athlete $athlete
 */
class LessonEdition extends Entity
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
        'lesson_id' => true,
        'lesson_edition_status_id' => true,
        'created' => true,
        'modified' => true,
        'athlete_id' => true,
        'user_id' => true,
        'lesson' => true,
        'lesson_status' => true,
        'notes' => true,
        'athlete' => true,
        'event' => true,
        'user' => true,
        'event_id' => true,
    ];

}
