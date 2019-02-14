<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
/**
 * Athlete Entity
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property \Cake\I18n\FrozenDate $birthdate
 * @property int $user_id
 * @property string $asi_subscription_number
 * @property \Cake\I18n\FrozenDate $asi_subscription_date
 *
 * @property \App\Model\Entity\User $user
 */
class Athlete extends Entity
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
        'surname' => true,
        'birthdate' => true,
        'responsible_person_id' => true,
        'asi_subscription_number' => true,
        'asi_subscription_date' => true,
        'responsible_person' => true,
        'purchased_lesson_editions_bundles' => true
    ];

    public function hasActiveSubscription() {
        if ($this->asi_subscription_date->modify('+1 Year') > Time::now()) {
            return true;
        }
        return $this->asi_subscription_date->modify('+1 Year');
    }

    public function isBusy($start_date, $end_date, $exclude) {
        $athletes_table = TableRegistry::getTableLocator()->get('Athletes');
        $busy_athletes = $athletes_table->find('busy', ['start_date' => $start_date, 'end_date' => $end_date, 'exclude' => $exclude])->find('list')->toArray();
        if (array_key_exists($this->id, $busy_athletes)) {
            return true;
        }
        return false;
    }

    public function hasValidLessonEditionsBundle($lesson_id) {
        return false;
    }
}
