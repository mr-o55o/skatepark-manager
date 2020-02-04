<?php
namespace App\Model\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;

/**
 * User Entity
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $role_id
 * @property string $name
 * @property string $surname
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property bool $active
 *
 * @property \App\Model\Entity\Role $role
 */
class User extends Entity
{
    public function parentNode()
    {
        if (!$this->id) {
            return null;
        }
        if (isset($this->role_id)) {
            $roleId = $this->role_id;
        } else {
            $Users = TableRegistry::get('Users');
            $user = $Users->find('all', ['fields' => ['role_id']])->where(['id' => $this->id])->first();
            $roleId = $user->role_id;
        }
        if (!$roleId) {
            return null;
        }
        return ['Roles' => ['id' => $roleId]];
    }

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
        'username' => true,
        'password' => true,
        'email' => true,
        'role_id' => true,
        'name' => true,
        'surname' => true,
        'created' => true,
        'modified' => true,
        'active' => true,
        'role' => true,
        'fiscal_code' => true,
        'birthdate' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var array
     */
    protected $_hidden = [
        'password'
    ];

    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }

    public function isBusy($start_date, $end_date, $exclude) {
        
        $users_table = TableRegistry::getTableLocator()->get('Users');
        $free_users = $users_table->find('free', ['start_date' => $start_date, 'end_date' => $end_date, 'exclude' => $exclude])->find('list')->toArray();
        if (array_key_exists($this->id, $free_users)) {
            return false;
        }
        return true;
    }
}
