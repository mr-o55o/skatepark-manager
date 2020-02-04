<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * LessonEditions Controller
 *
 * @property \App\Model\Table\LessonEditionsTable $LessonEditions
 *
 * @method \App\Model\Entity\LessonEdition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonEditionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('Search.Prg', [
            // This is default config. You can modify "actions" as needed to make
            // the PRG component work only for specified methods.
            'actions' => ['index', 'indexBooked']
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
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('All')->find('search', ['search' => $this->request->getQueryParams()]));

        $this->set(compact('lessonEditions'));
    }

    public function indexBooked()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('booked')->find('search', ['search' => $this->request->getQueryParams()])->order('Events.start_date'));

        $this->set(compact('lessonEditions'));
    }

    public function indexDraft()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('draft')->find('search', ['search' => $this->request->getQueryParams()])->order('Events.start_date'));

        $this->set(compact('lessonEditions'));
    }

    public function indexTrainerAssigned()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('trainerAssigned')->find('search', ['search' => $this->request->getQueryParams()])->order('Events.start_date'));

        $this->set(compact('lessonEditions'));
    }

    public function indexCompleted()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('completed')->find('search', ['search' => $this->request->getQueryParams()])->order('Events.start_date'));

        $this->set(compact('lessonEditions'));
    }

    public function indexCancelled()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('cancelled')->find('search', ['search' => $this->request->getQueryParams()])->order('Events.start_date'));

        $this->set(compact('lessonEditions'));
    }

    public function indexForAthlete($id = null)
    {
        $athlete = $this->LessonEditions->Athletes->get($id, [
            'contain' => []
        ]);
        $lessonEditions =$this->LessonEditions->find('withAthlete', ['athlete_id' => $id])->contain(['Lessons', 'LessonEditionStatuses', 'Users', 'Events']);
        $this->set('lessonEditions', $this->paginate($lessonEditions)); 
        $this->set('athlete', $athlete);       
    }

    /**
     * View method
     *
     * @param string|null $id Lesson Edition id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lesson_edition = $this->LessonEditions->get($id, [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Users', 'Events']
        ]);
        $this->set('lesson_edition', $lesson_edition);
    }



    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function addBooked()
    {
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        if (!$this->request->query('athlete_id')) {
            $this->Flash->error('Id Atleta mancante, impossibile proseguire.');
        }

        $athlete = $this->loadModel('Athletes')->get($this->request->query('athlete_id'));

        $trainerAssignedEditions = $this->paginate($this->LessonEditions->find('trainerAssigned')->contain(['Users', 'Lessons', 'Events']));

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            
            $lessonEdition = $this->LessonEditions->get($this->request->getData('id'), ['contain' => ['Events', 'Lessons', 'Users']]);
            $lessonEdition->athlete = $athlete;
            $lessonEdition->athlete_id = $athlete->id;
            $lessonEdition->lesson_edition_status_id = 3;

            //debug($lessonEdition);

            $this->getRequest()->getSession()->write('LessonEdition', $lessonEdition);
            $this->redirect(['action' => 'review']);
        }
        $this->set('athlete', $athlete);
        $this->set('lessonEditions', $trainerAssignedEditions);
        /*
        $lesson_edition = $this->LessonEditions->newEntity();
        if($athlete_id) {
            $athlete = $this->loadModel('Athletes')->get($athlete_id);
            $lesson_edition->athlete = $athlete;
            $lesson_edition->athlete_id = $athlete->id;
            $this->set('athlete', $athlete);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition = $this->LessonEditions->patchEntity($lesson_edition, $this->request->getData(), ['associated' => ['Lessons', 'Events']]);
            //set lesson edition status to draft
            $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['draft'];
            //get lesson data for received id
            $lesson = $this->LessonEditions->Lessons->get($lesson_edition->lesson_id);
            //attach lesson entity to lesson edition
            $lesson_edition->lesson = $lesson;
            //set event title
            $lesson_edition->event->title = $lesson->name;
            //set event end date
            $lesson_edition->event->end_date = $lesson_edition->event->start_date->modify('+ '. $lesson->duration .' minutes');
            //store lesson edition entity in session
            $this->getRequest()->getSession()->write('LessonEdition', $lesson_edition);
            $this->redirect(['action' => 'populate']);
        }
        $lessons = $this->LessonEditions->Lessons->find('active')->find('list', ['limit' => 200]);
        $this->set('lessons', $lessons); 
        $this->set('lesson_edition', $lesson_edition);
        */
    }

    /**
     * edit method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    
    public function edit($id = null)
    {
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Lessons', 'Events', 'Athletes', 'Users']]);
        $usersTable = $this->loadModel('Users');
        $available_trainers = $usersTable->find('free', ['start_date' => $lesson_edition->event->start_date, 'end_date' => $lesson_edition->event->end_date, 'exclude' => $exclude ])->where(['role_id' => 15])->find('list');
        //debug($available_trainers);
        if ($lesson_edition->lesson_edition_status_id > Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error('Edizione non modificabile');
            $this->redirect($this->referer());
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition = $this->LessonEditions->patchEntity($lesson_edition, $this->request->getData());

            if ($this->LessonEditions->save($lesson_edition)) {
                $this->Flash->success(__('Edizione aggiornata correttamente'));
            }
        }
        $this->set('lesson_edition', $lesson_edition);
        $this->set('available_trainers', $available_trainers->toArray());
    }
    

    public function populate() {
        //set referer for back button
        $ref = $this->request->referer();
        $this->set('ref', $ref);
        $lesson_edition = $this->getRequest()->getSession()->read('LessonEdition');
        $usersTable = $this->loadModel('Users');
        $athletesTable = $this->loadModel('Athletes');

        if ($lesson_edition == null) {
            $this->Flash->error(__('Lesson edition object not found in session, cannot proceed'));
            return $this->redirect($ref);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            //get the lesson edtion from session and complete it
            $lesson_edition = $this->getRequest()->getSession()->consume('LessonEdition');
            //add user entity if present
            if ($this->request->getData('user_id') != null ) {
                $trainer = $usersTable->get($this->request->getData('user_id'));
                if ($trainer != null ) {
                    $lesson_edition->user_id = $trainer->id;
                    $lesson_edition->user = $trainer;
                } else {
                    $this->Flash->error(__('Trainer not found'));
                }
            }
            //add athlete entity if present
            if ($this->request->getData('athlete_id') != null ) {
                $athlete = $athletesTable->get($this->request->getData('athlete_id'));
                if ($athlete != null ) {
                    $lesson_edition->athlete_id = $athlete->id;
                    $lesson_edition->athlete = $athlete;
                }
            }
            //set lesson edition status based on athlete and trainer presence
            if ($lesson_edition->user && $lesson_edition->athlete) {
                $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['booked'];
            } else {
                $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['scheduled'];
            }
            /*
            if ($this->LessonEditions->save($lesson_edition)) {
                $this->getRequest()->getSession()->delete('LessonEdition');
                $this->Flash->success(__('The lesson edition has been added.'));
                $this->redirect(['controller' => 'events', 'action' => 'calendar']);
            }
            */
            $this->getRequest()->getSession()->write('LessonEdition', $lesson_edition);

            if (!$lesson_edition->errors()) {
                
                $this->redirect(['action' => 'review']);

            } else {
                $this->set('errors', $lesson_edition->errors());
            }
        }
        $exclude = null;
        if (isset($lesson_edition->event->id)) {
            $exclude = $lesson_edition->event->id;
        }
        
        $available_trainers = $usersTable->find('free', ['start_date' => $lesson_edition->event->start_date, 'end_date' => $lesson_edition->event->end_date, 'exclude' => $exclude ])->where(['role_id' => 15])->find('list');
        //debug($available_trainers);
        $this->set('available_trainers', $available_trainers->toArray());
        $this->set('lesson_edition', $lesson_edition);
    }

    //save entity read from session
    public function review()
    {
        $lesson_edition = $this->getRequest()->getSession()->read('LessonEdition');
        //$usersTable = $this->loadModel('Users');
        //$athletesTable = $this->loadModel('Athletes');
        if ($lesson_edition == null) {
            $this->Flash->error(__('Lesson edition object not found in session, cannot proceed'));
            return $this->redirect($this->request->referer());
        }

        if ($lesson_edition->athlete) {

            //check if athlete is busy and set warning view variable if true
            if ($lesson_edition->athlete->isBusy($lesson_edition->event->start_date, $lesson_edition->event->end_date, $lesson_edition->event_id)) {
                $this->set('busy_athlete_warning', true);
            }    

            //check if athlete has a valid bundle
            $bundlesTable = $this->loadModel('PurchasedLessonEditionsBundles');
            $valid_bundle = $bundlesTable->find('valid')->where(['athlete_id' => $lesson_edition->athlete->id])->contain(['PurchasedLessonEditionsBundlesStatuses'])->toArray();
            if ($valid_bundle) {
                $this->set('valid_bundle', $valid_bundle);
            }    
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition->notes = $this->request->getData('notes');
            $lesson_edition->rent_skateboard = $this->request->getData('rent_skateboard');
            $lesson_edition->rent_helmet = $this->request->getData('rent_helmet');
            $lesson_edition->rent_pads = $this->request->getData('rent_pads');
            
            if($this->LessonEditions->save($lesson_edition)) {
                $this->getRequest()->getSession()->delete('LessonEdition');
                $this->Flash->success('Lesson edtion has been saved');
                $this->redirect(['controller' => 'events', 'action' => 'calendar']);
            } else {
                $this->set('errors', $lesson_edition->getErrors());
            }
            
        }

        $this->set('lesson_edition', $lesson_edition);      
    }

     /**
     * Complete method
     *
     * @param string|null $id Lesson Edition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function complete($id = null) {
        $lesson_edition = $this->LessonEditions->get($id, [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Users', 'Events', 'Athletes.ValidPurchasedLessonEditionsBundles.LessonEditionsBundles'],

            'associated' => ['Athletes.ValidPurchasedLessonEditionsBunldes']
        ]);

        //debug($lesson_edition);
         //ensure that lesson edition is booked
        if ($lesson_edition->lesson_edition_status_id <> Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error(__('Edizione non prenotata, operazione non permessa.'));
            return $this->redirect($this->referer());
        }  
        //to do get if any, the currently valid lesson edition buondle for athlete and type of lesson edition
        $idx = 0;
        foreach ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles as $validBundle) {
            if ($validBundle->lesson_editions_bundle->lesson_id == $lesson_edition->lesson_id) {
                $validBundleIndex = $idx;
                $this->set('validBundleIndex', $validBundleIndex);
            }
            $idx++;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {         
            $lesson_edition = $this->LessonEditions->patchEntity($lesson_edition, $this->request->getData(), ['associated' => ['Athletes.ValidPurchasedLessonEditionsBundles']]);

            if ($this->LessonEditions->complete($lesson_edition)) {
                $this->Flash->success(__('The lesson edition has been marked as completed.'));
                return $this->redirect(['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id]);
            }
                     
        }
        //return $this->redirect($this->referer());
        $this->set('lesson_edition', $lesson_edition);
    }

     /**
     * Cancel method
     *
     * @param string|null $id Lesson Edition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function cancel($id = null) {
        $lessonEdition = $this->LessonEditions->get($id, [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Users', 'Athletes', 'Events']
        ]);
         //ensure that lesson edition is  booked
        if ($lessonEdition->lesson_edition_status_id != Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error(__('This edition is not booked, operation not permitted.'));
            return $this->redirect($this->referer());
        }        
        if ($this->request->is(['patch', 'post', 'put'])) {         
            $data = $this->request->getData();
            // force status to cancelled by athlete or by staff
            if ( $data['setStatus'] == 0 ) {
                $lessonEdition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['cancelled-athlete'];
            } else {
                $lessonEdition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['cancelled-staff'];
            }
            $lessonEdition->notes = $data['notes'];
            
            if ($this->LessonEditions->save($lessonEdition)) {
                $this->Flash->success(__('The lesson edition has been marked as cancelled.'));
                return $this->redirect(['controller' => 'events', 'action' => 'calendar']);
            }
            $this->Flash->error(__('The lesson edition could not be updated. Please, try again.'));
            $this->set('errors', $lessonEdition->getErrors());
        }
        //return $this->redirect($this->referer());
        $this->set('lessonEdition', $lessonEdition);
    }

    public function wizard() {
        $wizard = null;
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            $start_date = new Time();
            $start_date->year($this->request->getData('start_date')['year']);
            $start_date->month($this->request->getData('start_date')['month']);
            $start_date->day($this->request->getData('start_date')['day']);
            $end_date = new Time();
            $end_date->year($this->request->getData('end_date')['year']);
            $end_date->month($this->request->getData('end_date')['month']);
            $end_date->day($this->request->getData('end_date')['day']);
            $daily_start_hour = $this->request->getData('daily_start_hour');
            $daily_end_hour = $this->request->getData('daily_end_hour');
/*
            $wizard->start_date = $start_date;
            $wizard->end_date = $end_date;
            $wizard->daily_start_hour = $daily_start_hour;
            $wizard->daily_end_hour = $daily_end_hour;
*/
            if ($start_date->diffInDays($end_date) > 30 ) {
                $this->Flash->error('Non è possibile usare il wizard per creare lezioni in un periodo superiore a 30 giorni');
                return $this->redirect(['action' => 'wizard']);
            }
            if (empty($this->request->getData('week_days'))) {
                $weekdays = ['1', '2', '3', '4', '5', '6','7'];
            } else {
                $weekdays = $this->request->getData('week_days');
            }

            $wizard_output = $this->LessonEditions->createDrafts($start_date, $end_date, $daily_start_hour, $daily_end_hour, $weekdays, 1);
            //debug($wizard_output);
            $this->set('wizard_output', $wizard_output);            
        }
        $this->set('wizard', $wizard);

    } 

    public function changeTrainer($id = null)
    {
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Lessons', 'Events', 'Athletes', 'Users']]);
        $usersTable = $this->loadModel('Users');
        $exclude = null;
        $available_trainers = $usersTable->find('free', ['start_date' => $lesson_edition->event->start_date, 'end_date' => $lesson_edition->event->end_date, 'exclude' => $exclude ])->where(['role_id' => 15])->find('list');       
        if ($lesson_edition->lesson_edition_status_id > Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error('Edizione non modificabile');
            $this->redirect($this->referer());
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition = $this->LessonEditions->patchEntity($lesson_edition, $this->request->getData());
            //force status to trainer assigned;
            //$lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['trainer-assigned'];
            if ($this->LessonEditions->save($lesson_edition)) {
                $this->Flash->success(__('Edizione aggiornata correttamente'));
                $this->redirect(['action' => 'view', $lesson_edition->id]);
            }
        }
        $this->set('lesson_edition', $lesson_edition);
        $this->set('available_trainers', $available_trainers);        
    }

    public function removeTrainer($id = null)
    {
        $this->request->allowMethod(['post']);
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Events', 'Users']]);

        if ($lesson_edition->lesson_edition_status_id > Configure::read('lesson_edition_statuses')['trainer-assigned']) {
            $this->Flash->error(__('Non è possibile rimuovere l\'istruttore per una lezione in questo stato.'));
            $this->redirect(['action' => 'view', $lesson_edition->id]);
        }
        $lesson_edition->user_id = null;
        $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['draft'];
        if ($this->LessonEditions->save($lesson_edition)) {
            $this->Flash->success('Istruttore rimosso dall\'edizione');
        } else {
            $this->Flash->error('Errore nella rimozione dell\'istruttore');
        }
        $this->redirect(['action' => 'view', $lesson_edition->id]);
    }

    public function manageEquipRental($id = null) {
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Events', 'Users', 'Lessons']]);
        if ($lesson_edition->lesson_edition_status_id > Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error(__('Non è possibile modificare questa edizione.'));
            $this->redirect(['action' => 'view', $lesson_edition->id]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition = $this->LessonEditions->patchEntity($lesson_edition);
            if ($this->save($lesson_edition)) {
                $this->Flash->success(__('Noleggio equipaggiamento aggiornato per l\'edizione: ').$lesson_edition->id);
                $this->redirect(['action' => 'view', $lesson_edition->id]);
            } else {
                $this->Flash->error('Errore nel salvataggio, riprovare con le dita incrociate.');
            }
        }
        $this->set('lesson_edition', $lesson_edition);
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
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Events', 'Users']]);

        if ($lesson_edition->lesson_edition_status_id < Configure::read('lesson_edition_statuses')['draft']) {
            $this->Flash->error(__('Non è possibile eliminare un\'edizione  che non è in bozza'));
            $this->redirect(['action' => 'view', $lesson_edition->id]);
        }

        //to correctly delete an activity and its associated data, we delete thereferenced event
        $events = $this->loadModel('Events');

        if ($events->delete($lesson_edition->event)) {
            $this->Flash->success(__('Edizione eliminata.'));
        } else {
            $this->Flash->error(__('Errore durante la cancellazione.'));
        }

        return $this->redirect(['action' => 'indexDraft']);
    }

    public function book() 
    {
        $athlete_id = $this->request->getQuery('athlete_id');
        $athletesTable = $this->LoadModel('Athletes');
        $athlete = $athletesTable->get($athlete_id);
        $this->paginate = [
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Athletes', 'Events', 'Users']
        ];
        $lessonEditions = $this->paginate($this->LessonEditions->find('trainerAssigned'));

        if ($this->request->is(['patch', 'post', 'put'])) {
            if($id) {
                //save edition with athlete
            } else {

            }
        }
        $this->set('lessonEditions', $lessonEditions);       
    }

    public function bookForAthlete($id = null)
    {
        $lesson_edition = $this->LessonEditions->get($id, ['contain' => ['Lessons', 'Events', 'Athletes', 'Users']]);
        
        //debug($lesson_edition);
        if ($lesson_edition->lesson_edition_status_id != Configure::read('lesson_edition_statuses')['trainer-assigned']) {
            $this->Flash->error('Operazione non permessa su un\'edizione nello stato attuale');
            $this->redirect(['action' => 'view', $lesson_edition->id]);
        }
        if ($lesson_edition->has('athlete')) {
            $this->Flash->error('Operazione non permessa, edizione già prenotata per un atleta');
            $this->redirect(['action' => 'view', $lesson_edition->id]);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            $athlete = $this->loadModel('Athletes')->get($this->request->getData('athlete_id'));

            if ($athlete) {
                $lesson_edition->athlete = $athlete;
                $lesson_edition->athlete_id= $athlete->id;               
            } else {
                $this->Flash->error(__('Atleta non trovato, impossibile effettuare la prenotazione'));
                $this->redirect(['action' => 'view', $lesson_edition->id]);
            }
            //Attempt booking operation
            $bookOperationOutcome = $this->LessonEditions->book($lesson_edition);
            if ($bookOperationOutcome === true) {
                $this->Flash->success(__('Edizione '.$lesson_edition->id.' prenotata per '.$lesson_edition->athlete->name.' '.$lesson_edition->athlete->surname));
                $this->redirect(['action' => 'view', $lesson_edition->id]);
            } else {
                $this->Flash->error('Errore nela prenotazione dell\'edizione, prenotazione non effettuata, errori rilevati: '.$bookOperationOutcome);
            }  
        }
        $this->set('lesson_edition', $lesson_edition);
    }

}
