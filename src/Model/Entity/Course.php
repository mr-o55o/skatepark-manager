<?php
namespace App\Model\Entity;
use Cake\ORM\TableRegistry;
use Cake\ORM\Entity;
use Cake\Core\Configure;
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
        'week_days' => true,
        'start_time' => true,
        'duration' => true,
        'price' => true,
        'course_status_id' => true,
        'course_status' => true,
        'start_date' => true,
        'end_date' => true
    ];

    /*
    un corso è completabile se:
    - ha lo stato active
    - ha almeno una sessione completata
    - non ha sessioni scheduled
    - non ha iscrizioni non pagate
    */
    public function isCompletable() {
        return true;
    }

    /*
    un corso è attivabile se
    - ha lo stato scheduled
    - ha delle sessioni e sono tutte in stato scheduled
    */
    public function isActivable() {
        return true;

    }
    /*
    un corso è pianificabile se:
    - ha lo status draft
    */
    public function isSchedulable() {
        if ($this->course_status_>id <> Configure::read('course_statuses')['draft']) {
            return false;
        }
        return true;
    }

    /*
    un corso è annullabile se:
    - ha lo status scheduled o active
    - non ha sessioni  in stato scheduled
    */
    public function isCancellable()
    {   
        return true;
    }

    public function isEditable()
    {
        if ($this->course_status_id == Configure::read('course_statuses')['completed'] || $this->course_status_id == Configure::read('course_statuses')['cancelled']) {
            return false;
        }
        return true;
    }
}
