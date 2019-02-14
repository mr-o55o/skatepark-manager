<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Athletes Controller
 *
 * @property \App\Model\Table\AthletesTable $Athletes
 *
 * @method \App\Model\Entity\Athlete[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AthletesController extends AppController
{

    public $paginate = [
        'sortWhitelist' => ['id', 'name', 'surname', 'birthdate', 'asi_subscription_date'],
        'contain' => ['ResponsiblePersons', 'PurchasedLessonEditionsBundles']
    ];


    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index']
        ]);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['ResponsiblePersons']
        ];
        $query = $this->Athletes->find('search', ['search' => $this->request->getQueryParams()]);
        $this->set('athletes', $this->paginate($query));
    }

    /**
     * Index Expired method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexExpired()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $athletes = $this->paginate($this->Athletes->find('Expired'));

        $this->set(compact('athletes'));
    }

    /**
     * Index Active method
     *
     * @return \Cake\Http\Response|void
     */
    public function indexActive()
    {
        $this->paginate = [
            'contain' => ['ResponsiblePersons']
        ];
        $athletes = $this->paginate($this->Athletes->find('Active'));

        $this->set(compact('athletes'));
    }

    /**
     * Search method
     *
     * @return \Cake\Http\Response|void
     */
    public function search()
    {
        $athlete = $this->Athletes->newEntity();
        if ($this->request->is('post')) {
            $athlete = $this->Athletes->patchEntity($athlete, $this->request->getData());
            
            $this->paginate = [
                'contain' => ['Users']
            ];
            
            $athletes = $this->paginate($this->Athletes->find('search', ['name' => $athlete->name, 'surname' => $athlete->surname]));
            $this->set(compact('athletes'));
        }
        $this->set(compact('athlete'));
    }

    /**
     * AjaxSearch method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxSearch()
    {

        $athletes = $this->Athletes->find('searchBySurname', ['surname' => $this->request->getQuery('surname')]);

        $this->set(compact('athletes')); // Pass $data to the view
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->set('_serialize', ['athletes']);
        //$this->response->withStringBody(json_encode($jsonResponse));
    }

    /**
     * AjaxSearch method
     *
     * @return \Cake\Http\Response|void
     */
    public function ajaxSearchActive()
    {

        $athletes = $this->Athletes->find('searchBySurnameActive', ['surname' => $this->request->getQuery('surname')]);

        $this->set(compact('athletes')); // Pass $data to the view
        $this->set('_jsonOptions', JSON_FORCE_OBJECT);
        $this->set('_serialize', ['athletes']);
        //$this->response->withStringBody(json_encode($jsonResponse));
    }

    /**
     * View method
     *
     * @param string|null $id Athlete id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $athlete = $this->Athletes->get($id, [
            'contain' => ['ResponsiblePersons']
        ]);

        $countBookedLessonEditions = $this->Athletes->LessonEditions->find('bookedByAthlete', ['athlete_id' => $id ])->count();
        $countCompletedLessonEditions = $this->Athletes->LessonEditions->find('completedByAthlete', ['athlete_id' => $id ])->count();
        $countValidLessonEditionsBundles = $this->Athletes->PurchasedLessonEditionsBundles->find('valid')->where(['athlete_id' => $athlete->id])->count();
        $countPurchasedLessonEditionsBundles = $this->Athletes->PurchasedLessonEditionsBundles->find('all')->where(['athlete_id' => $athlete->id])->count();

        $this->loadModel('LessonEditions');
        $this->set('athlete', $athlete);
        $this->set('countBookedLessonEditions', $countBookedLessonEditions);
        $this->set('countCompletedLessonEditions', $countCompletedLessonEditions);
        $this->set('countValidLessonEditionsBundles', $countValidLessonEditionsBundles);
        $this->set('countPurchasedLessonEditionsBundles', $countPurchasedLessonEditionsBundles);

    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $athlete = $this->Athletes->newEntity();

        if ($this->request->is('post')) {
            $athlete = $this->Athletes->patchEntity($athlete, $this->request->getData(), ['contain' => 'ResponsiblePersons']);
            if ($this->Athletes->save($athlete)) {
                $this->Flash->success(__('The athlete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->set('errors', $athlete->getErrors()); 
            $this->Flash->error(__('The athlete could not be saved. Please, try again.'));
            
        }

        $this->set(compact('athlete', 'errors'));
    }
      
    /**
     * Edit method
     *
     * @param string|null $id Athlete id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $athlete = $this->Athletes->get($id, [
            'contain' => ['ResponsiblePersons']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $athlete = $this->Athletes->patchEntity($athlete, $this->request->getData());
            debug($athlete);
            if ($this->Athletes->save($athlete)) {
                $this->Flash->success(__('The athlete has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The athlete could not be saved. Please, try again.'));
        }
        //$responsible_persons = $this->Athletes->ResponsiblePersons->find('list', ['limit' => 200]);
        $this->set(compact('athlete'));
    }

    public function removeResponsiblePerson($id = null)
    {
        $this->request->allowMethod(['post']);
        $athlete = $this->Athletes->get($id);
        $athlete->responsible_person_id = null;
        if ($this->Athletes->save($athlete)) {
            $this->redirect(['action' => 'edit', $id]);
        } else {
            $this->Flash->error(__('Error attempting to remove responsible person'));
            $this->redirect(['action' => 'edit', $id]);
        }
        
    }

    public function renewAsiSubscription($id = null)
    {
        $athlete = $this->Athletes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $athlete = $this->Athletes->patchEntity($athlete, $this->request->getData());
            if ($this->Athletes->save($athlete)) {
                $this->Flash->success(__('Asi subscription renewed for '.$athlete->name.' '.$athlete->surname));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Renew of the subscription failed.'));
        }
        //$users = $this->Athletes->Users->find('list', ['limit' => 200]);
        $this->set(compact('athlete'));      
    }
}
