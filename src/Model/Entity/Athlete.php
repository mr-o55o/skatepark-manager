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
        'sex' => true,
        'fiscal_code' => true,
        'birth_city' => true,
        'birth_province_code' => true,
        'city' => true,
        'province_code' => true,
        'phone' => true,
        'email' => true,
        'postal_code' => true,
        'instagram_account' => true,
        'twitter_account' => true,
        'responsible_person_id' => true,
        'disabled_person' => true,
        'competitive' => true,
        'asi_subscription_number' => true,
        'asi_subscription_date' => true,
        'fisr_subscription_number' => true,
        'fisr_subscription_date' => true,        
        'responsible_person' => true,
        'purchased_lesson_editions_bundles' => true,
        'valid_purchased_lesson_editions_bundles' => true,
    ];
    // To deprecate asap!
    /*
    public function hasActiveSubscription() {
        if ($this->asi_subscription_date->modify('+1 Year') > Time::now()) {
            return true;
        }
        return $this->asi_subscription_date->modify('+1 Year');
    }
    */

    public function hasValidSubscriptions($date = null) {
        if ($this->asi_subscription_date == null && $this->fisr_subscription_date == null) {
            return false;
        }
        if ($date != null ) {
            if ($this->asi_subscription_date != null && $this->asi_subscription_date->modify('+1 Year') < $date or ($this->fisr_subscription_date != null && $this->fisr_subscription_date->modify('+1 Year') < $date)) {
                return false;
            }  
        } else {
            if ($this->asi_subscription_date != null && $this->asi_subscription_date->modify('+1 Year') < Time::now() or ($this->fisr_subscription_date != null && $this->fisr_subscription_date->modify('+1 Year') < Time::now())) {
                return false;
            }            
        }

        return true;
    }

    public function isBusy($start_date, $end_date, $exclude) {
        $athletes_table = TableRegistry::getTableLocator()->get('Athletes');
        $busy_athletes = $athletes_table->find('busy', ['start_date' => $start_date, 'end_date' => $end_date, 'exclude' => $exclude])->find('list')->toArray();
        if (array_key_exists($this->id, $busy_athletes)) {
            return true;
        }
        return false;
    }

    public function getValidBundles() {
        $purchasedBundles = TableRegistry::getTableLocator()->get('PurchasedLessonEditionsBundles')->find('valid')->contain(['LessonEditionsBundles'])->where(['athlete_id' => $this->id ]);
        return $purchasedBundles;
    }

    protected function _getAsiSubscriptionAge()
    {
        if ($this->asi_subscription_date == null) {
            return 999;
        }
        return $this->asi_subscription_date->diffInYears(Time::now());
    }
}
