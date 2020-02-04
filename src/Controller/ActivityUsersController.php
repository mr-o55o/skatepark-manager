<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;

/**
 * ActivityUsers Controller
 *
 * @property \App\Model\Table\ActivityUsersTable $ActivityUsers
 *
 * @method \App\Model\Entity\ActivityUser[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ActivityUsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Activities', 'Users']
        ];
        $activityUsers = $this->paginate($this->ActivityUsers);

        $this->set(compact('activityUsers'));
    }

    /**
     * View method
     *
     * @param string|null $id Activity User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $activityUser = $this->ActivityUsers->get($id, [
            'contain' => ['Activities', 'Users']
        ]);

        $this->set('activityUser', $activityUser);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $activityUser = $this->ActivityUsers->newEntity();
        $activity_id = $this->request->getQuery('activity_id');

        $activity = $this->ActivityUsers->Activities->get($activity_id, [
            'contain' => ['Events']
        ]);

        /* TO-DO 
            check exsistance of activity_id
            check that activity is in an editable status
        */
        if ($this->request->is('post')) {
            $activityUser = $this->ActivityUsers->patchEntity($activityUser, $this->request->getData());

            $activityUser->activity_id = $activity_id;

            if ($this->ActivityUsers->save($activityUser)) {
                $this->Flash->success(__('Membro dello staff aggiunto all\'attività.'));

                $this->redirect(['controller' => 'Activities', 'action' => 'view', $activity_id]);
            } else {
                $this->Flash->error(__('Attenzione: violata regola applicativa nella getstione di una attività. Contattare l\'amministratore.'));
            }
            
        }
        //$activities = $this->ActivityUsers->Activities->find('list', ['limit' => 200]);
        $exclude= $activity->event_id;
        $availableUsers = $this->ActivityUsers->Users->find('free', ['start_date' => $activity->event->start_date, 'end_date' => $activity->event->end_date, 'exclude' => null ])->find('list');
        $this->set('activityUser', $activityUser);
        $this->set('activity_id', $activity->id);
        $this->set('availableUsers', $availableUsers->toArray());
    }


    /**
     * Edit method
     *
     * @param string|null $id Activity User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $activityUser = $this->ActivityUsers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $activityUser = $this->ActivityUsers->patchEntity($activityUser, $this->request->getData());
            if ($this->ActivityUsers->save($activityUser)) {
                $this->Flash->success(__('The activity user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The activity user could not be saved. Please, try again.'));
        }
        $activities = $this->ActivityUsers->Activities->find('list', ['limit' => 200]);
        $users = $this->ActivityUsers->Users->find('list', ['limit' => 200]);
        $this->set(compact('activityUser', 'activities', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Activity User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $activityUser = $this->ActivityUsers->get($id);
        if ($this->ActivityUsers->delete($activityUser)) {
            $this->Flash->success(__('Membro dello staff eliminato da questa attività'));
        } else {
            $this->Flash->error(__('Errore durante eliminazione associazione utente/attività'));
        }

        return $this->redirect(['controller' => 'Activities', 'action' => 'view', $activityUser->activity_id]);
    }
}
