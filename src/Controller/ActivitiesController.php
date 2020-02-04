<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Core\Configure;
/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'indexUpcoming']
        ]);
    }

    public $paginate = [
        'contain' => ['Events', 'ActivityTypes', 'ActivityStatuses', 'ActivityUsers.Users'],
        'sortWhitelist' => [
            'id', 'ActivityTypes.name', 'Users.username', 'created', 'modified', 'Events.start_date', 'Events.end_date'
        ],
        'maxLimit' => 10,
        'order' => ['Events.start_date' => 'asc'] 
    ];

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $activities = $this->paginate($this->Activities);

        $this->set(compact('activities'));
    }

    /**
     * Index Upcoming method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexUpcoming()
    {
        $activities = $this->paginate($this->Activities->find()->where(['Events.start_date >' => Time::now() ])->order('events.start_date ASC'));

        $this->set(compact('activities'));
    }

    /**
     * Index Scheduled method
     *
     * @return \Cake\Http\Response|void
    */
    public function indexScheduled()
    {
        $activities = $this->paginate($this->Activities->find('scheduled')->order('events.start_date ASC'));

        $this->set(compact('activities'));
    }   

    /**
     * View method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['ActivityTypes', 'ActivityStatuses', 'Events', 'ActivityUsers.Users']
        ]);

        $this->set('activity', $activity);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activity = $this->Activities->newEntity();
        if($activity->user_id) {
            $user = $this->loadModel('Users')->get($user_id);
            $activity->user = $user;
            $activity->user_id = $user->id;
            $this->set('user', $user);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            //debug($this->request->getData());
            $activity = $this->Activities->patchEntity($activity, $this->request->getData(), ['associated' => ['ActivityTypes', 'Events']]);
            
            $activity->activity_status_id = 1;
            $activity->event->end_date = $activity->event->start_date->modify('+ '.$this->request->getData()['duration'].' hours');

            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('Attività salvata correttamente con Id ').$activity->id.'.');
                $this->redirect(['controller' => 'ActivityUsers', 'action' => 'add', '?' => ['activity_id' => $activity->id]]);
            } else {
                $this->Flash->error(__('Attenzione, violate regole applicative'));
            }
        }
        $activity_types = $this->Activities->ActivityTypes->find('list', ['limit' => 200]);
        $this->set('activity_types', $activity_types); 
        $this->set('activity', $activity);
    }

    /**
     * populate method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function populate()
    {
        //set referer for back button
        $ref = $this->request->referer();
        $this->set('ref', $ref);
        $activity = $this->getRequest()->getSession()->read('Activity');
        $usersTable = $this->loadModel('Users');
        //debug($activity);
        if ($activity == null) {
            $this->Flash->error(__('Lesson edition object not found in session, cannot proceed'));
            return $this->redirect($ref);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            $activity->user_id = $this->request->getData()['user_id'];

            if($this->Activities->save($activity)) {
                $this->getRequest()->getSession()->delete('Activity');
                $this->Flash->success('Attività programmata con successo.');
                $this->redirect(['controller' => 'events', 'action' => 'calendar']);
            } else {
                $this->set('errors', $activity->getErrors());
            }
            
        }

        $exclude = null;
        if (isset($lesson_edition->event->id)) {
            $exclude = $activities->event->id;
        }       

        $available_users = $usersTable->find('free', ['start_date' => $activity->event->start_date, 'end_date' => $activity->event->end_date, 'exclude' => $exclude ])->find('list');

        $this->set('available_users', $available_users->toArray()); 
        $this->set('activity', $activity);      


    }
    */

    /**
     * Edit method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Users', 'ActivityTypes', 'ActivityStatuses', 'Events', 'ActivityUsers.Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('The activity has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity could not be saved. Please, try again.'));
        }
        $users = $this->Activities->Users->find('list', ['limit' => 200]);
        $activityTypes = $this->Activities->ActivityTypes->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'users', 'activityTypes'));
    }



    /**
     * Change User method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects on successful change, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    /*
    public function changeUser($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['Users', 'ActivityTypes', 'ActivityStatuses', 'Events', 'ActivityUsers.Users']
        ]);

        //change user is allowed for draft and scheduled activities
        if ($activity->activity_status_id > 2) {
            $this->Flash->error(__('Non è possibile modificare il responsabile di un attività conclusa o annullata'));
            $this->redirect(['action' => 'index']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('il responsabile attività è stato aggiornato.'));
                return $this->redirect(['action' => 'view', $activity->id]);
            }
        }
        $users = $this->Activities->Users->find('Free', [ 'start_date' => $activity->event->start_date, 'end_date' => $activity->event->end_date, 'exclude' => $activity->event->id ])->find('list');

        $this->set(compact('activity', 'users'));            
    }
    */

    /**
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activity = $this->Activities->get($id, ['contain' => 'Events', 'ActivityUsers']);

        if ($activity->activity_status_id <> Configure::read('activity_statuses')['draft']) {
            $this->Flash->error(__('Non è possibile eliminare una attività che non è in bozza'));
            $this->redirect(['action' => 'view', $activity->id]);
        }

        //to correctly delete an activity and its associated data, we delete thereferenced event
        $events = $this->loadModel('Events');

        if ($events->delete($activity->event)) {
            $this->Flash->success(__('Attività eliminata.'));
        } else {
            $this->Flash->error(__('Errore durante la cancellazione.'));
        }

        return $this->redirect(['action' => 'indexScheduled']);
    }


    /**
     * Schedule method
     * set lesson edition status as scheduled and updates associated event
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function schedule($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['ActivityTypes', 'ActivityStatuses', 'Events', 'ActivityUsers.Users']
        ]);
        //refuse to schedule an activity not in draft status
        if ($activity->activity_status_id != Configure::read('activity_statuses')['draft']) {
            $this->Flash->error(__('Non è possibile pianificare un\'attività che non sia in bozza'));
        } elseif ($activity->event->start_date < Time::now()) {
            $this->Flash->error(__('Non è possibile pianificare un\'attività che inizia nel passato'));
        } else {
            //debug('scheduling activity...');
            if ($this->request->is(['patch', 'post', 'put'])) {
                //$activity = $this->Activities->patchEntity($activity, $this->request->getData());
                //set status to scheduled;
                $activity->activity_status_id = 2;
                //debug($activity);

                if ($this->Activities->save($activity)) {
                    $this->Flash->success(__('Attività pianificata correttamente.'));
                    $this->redirect(['action' => 'view', $activity->id]);
                } else {
                    $this->Flash->error(__('Attenzione: violata regola regola di business nella pianificazione dell\'attività.'));
                } 
            }          
        } 
        $this->set('activity', $activity);  
    }

    public function complete($id = null)
    {
        $activity = $this->Activities->get($id, [
            'contain' => ['ActivityTypes', 'ActivityStatuses', 'Events', 'ActivityUsers.Users']
        ]);

        if ($activity->activity_status_id <> Configure::read('activity_statuses')['scheduled']) {
            $this->Flash->error(__('Non è possibile completare una attività che non è pianificata'));
            $this->redirect(['action' => 'view', $activity->id]);
        }

        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activity = $this->Activities->patchEntity($activity, $this->request->getData());
            $activity->activity_status_id = Configure::read('activity_statuses')['completed'];
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('Attiità completata.'));
                return $this->redirect(['action' => 'view', $activity->id]);
            }
            $this->Flash->error(__('Errore durante il salvataggio dell\'attività.'));           
        }
        $this->set('activity', $activity);
    }

}
