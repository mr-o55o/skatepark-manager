<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;
use Cake\Core\Configure;


/**
 * UsersAvailability Controller
 *
 * @property \App\Model\Table\UsersAvailabilityTable $UsersAvailability
 *
 * @method \App\Model\Entity\UsersAvailability[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersAvailabilityController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Calendar.Calendar');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $usersAvailability = $this->paginate($this->UsersAvailability);

        $this->set(compact('usersAvailability'));
    }

    /**
     * Calendar method
     *
     * @return \Cake\Http\Response|void
     */
    public function calendar($year = null, $month = null)
    {
        $this->Calendar->init($year, $month);
        $options = [
            'year' => $this->Calendar->year(),
            'month' => $this->Calendar->month(),
            'contain' => ['Users', 'Users.Roles'],
        ];

        $usersAvailability = $this->UsersAvailability->find('calendar', $options)->order(['start_date']);

        $this->set(compact('usersAvailability'));
    }

    public function day($string_date = null) {

        $current_day = new FrozenDate($string_date);

        $usersAvailabilities = $this->UsersAvailability->find('inDay', ['day' => $current_day]);
        $this->set('usersAvailabilities', $usersAvailabilities);
        $this->set('back_url', $this->referer());
        $this->set('current_day', $current_day);
    }


    /**
     * View method
     *
     * @param string|null $id Users Availability id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersAvailability = $this->UsersAvailability->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersAvailability', $usersAvailability);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        return null;
    }

    /**
     * Add for a day method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addForDay()
    {
        return null;
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addMultiple()
    {
        $usersAvailability = $this->UsersAvailability->newEntity();
        if ($this->request->is('post')) {
            $from = Chronos::create($this->request->getData('from')['year'], $this->request->getData('from')['month'], $this->request->getData('from')['day']);
            $to = Chronos::create($this->request->getData('to')['year'], $this->request->getData('to')['month'], $this->request->getData('to')['day']);

            if ($from->diffInDays($to) > 30) {
                $this->Flash->error(__('Intervallo di tempo troppo esteso, deve essere inferiore a 30 giorni'));
            } else {
                $current = $from;
                $week_days = $this->request->getData('week_days');
                //debug($week_days);

                $data = [];
                $element = 0;
                while($current <= $to) {
                    //debug('current_day_of_week: '.$current->dayOfWeek);

                    if (empty($week_days)) {
                            $data[$element]['user_id'] = $this->request->getData('user_id');
                            $data[$element]['start_date'] = $current->startOfDay();
                            $data[$element]['end_date'] = $current->endOfDay();
                    } else {
                        if (in_array($current->dayOfWeek, $week_days, false)) {
                            //add a new entity
                            //debug('match found for weekday '.$current->dayOfWeek);
                            $data[$element]['user_id'] = $this->request->getData('user_id');
                            $data[$element]['start_date'] = $current->startOfDay();
                            $data[$element]['end_date'] = $current->endOfDay();
                        }                   
                    }

                    $element++;
                    $current = $current->addDay(1);

                }

                if (empty($data)) {
                    return $this->Flash->error('Nessuna giornata trovata per l\'intervallo di tempo e la selezione di giorni della settimana proposti.');
                } else {
                    $userAvailabilities = $this->UsersAvailability->newEntities($data);
                    if ($this->UsersAvailability->saveMany($userAvailabilities)) {
                        $this->Flash->success(__('Disponibilità registrate.'));
                    }   else {
                        $this->Flash->error(__('Errore nel salvataggio di una o più giornate di disponibilità. Nessuna giornata è stata aggiunta.'));
                    } 
                    $this->set('userAvailabilities', $userAvailabilities);            
                }
            }
        }
        $users = $this->UsersAvailability->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersAvailability', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Availability id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersAvailability = $this->UsersAvailability->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersAvailability = $this->UsersAvailability->patchEntity($usersAvailability, $this->request->getData());
            if ($this->UsersAvailability->save($usersAvailability)) {
                $this->Flash->success(__('The users availability has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users availability could not be saved. Please, try again.'));
        }
        $users = $this->UsersAvailability->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersAvailability', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Availability id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersAvailability = $this->UsersAvailability->get($id);

        if ($usersAvailability->end_date->isPast()) {
            $this->Flash->error('Non è possibile eliminare una disponibilità nel passato');
            $this->redirect(['action' => 'calendar']);
        }

        if ($this->UsersAvailability->deleteTransactional($usersAvailability)) {
            $this->Flash->success('Disponibilità eliminata.');
            //$this->redirect(['action' = 'calendar']);
        } else {
            $this->Flash->error('Errore inaspettato.');
        }

    }
}
