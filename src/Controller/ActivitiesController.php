<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
/**
 * Activities Controller
 *
 * @property \App\Model\Table\ActivitiesTable $Activities
 *
 * @method \App\Model\Entity\Activity[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'ActivityTypes', 'ActivityStatuses', 'UserActivities']
        ];
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
        $this->paginate = [
            'contain' => ['Users', 'ActivityTypes', 'Events']
        ];
        $activities = $this->paginate($this->Activities->find()->where(['Events.start_date >' => Time::now() ])->order('events.start_date ASC'));

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
            'contain' => ['Users', 'ActivityTypes', 'Events', 'UserActivities']
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

            //get activity type for received id
            $activity_type = $this->Activities->ActivityTypes->get($activity->activity_type_id);
            //attach lesson entity to lesson edition
            $activity->activity_type = $activity_type;
            //set event title
            $activity->event->title = $activity_type->name;
            $activity->event->end_date = $activity->event->start_date->modify('+ '.$this->request->getData()['duration'].' hours');
            //store lesson edition entity in session
            //debug($activity);
            $this->getRequest()->getSession()->write('Activity', $activity);
            $this->redirect(['action' => 'populate']);
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
            'contain' => []
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
     * Delete method
     *
     * @param string|null $id Activity id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activity = $this->Activities->get($id);
        if ($this->Activities->delete($activity)) {
            $this->Flash->success(__('The activity has been deleted.'));
        } else {
            $this->Flash->error(__('The activity could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    /**
     * Schedule method
     * set lesson edition status as scheduled and updates associated event
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function add($id = null)
    {
        $activity = $this->Activities->newEntity();
        if ($this->request->is(['patch', 'post', 'put'])) {

            $duration = $this->request->getData('duration');

            $activity = $this->Activities->patchEntity($activity, $this->request->getData(), [
                'contain' => ['Events', 'Users']
            ]);
            
            $activity_type = TableRegistry::getTableLocator()->get('ActivityTypes')->get($activity->activity_type_id);
            $user = TableRegistry::getTableLocator()->get('Users')->get($activity->user_id);
            //debug($lesson);
            
            // set event fk
            $activity->event->activity_id = $activity->id;
            // set event title
            $activity->event->title = $activity_type->name; 

            //set event end date
            $activity->event->end_date = $activity->event->start_date->modify('+'.$duration.' hours');

            debug($activity);
            if ($this->Activities->save($activity)) {
                $this->Flash->success(__('Activity has been scheduled.'));
                return $this->redirect(['controller' => 'events', 'action' => 'calendar']);
            }
            //$this->Flash->error(__('Activity could not be scheduled. Please, try again.'));
            
            $this->set('errors', $activity->getErrors());

        }
        $activity_types = $this->Activities->ActivityTypes->find('list', ['limit' => 200]);
        $this->set(compact('activity', 'activity_types')); 
    }
    */

}
