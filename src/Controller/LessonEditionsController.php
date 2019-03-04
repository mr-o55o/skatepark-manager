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
        $lessonEditions = $this->paginate($this->LessonEditions->find('booked')->find('search', ['search' => $this->request->getQueryParams()]));

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
    public function add($athlete_id = null)
    {
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
    }

    /**
     * edit method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function edit($id = null)
    {
        $lesson_edition = $this->LessonEditions->get($id);

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
    }
    */

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
        
        $available_trainers = $usersTable->find('freeTrainers', ['start_date' => $lesson_edition->event->start_date, 'end_date' => $lesson_edition->event->end_date, 'exclude' => $exclude ])->find('list');

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

        if (!empty($lesson_edition->athlete) && $lesson_edition->athlete->isBusy($lesson_edition->event->start_date, $lesson_edition->event->end_date, $lesson_edition->event_id)) {
            $this->set('busy_athlete_warning', true);
        }
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lesson_edition->notes = $this->request->getData('notes');

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

        
         //ensure that lesson edition is booked
        if ($lesson_edition->lesson_edition_status_id <> Configure::read('lesson_edition_statuses')['booked']) {
            $this->Flash->error(__('This edition is not booked, operation not permitted.'));
            return $this->redirect($this->referer());
        }  
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
            // force status to completed
            $lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['completed'];
            

            // to-do make a better check, must verify also that id of the bundle matches id of thelesson
            if (!empty($lesson_edition->athlete->valid_purchased_lesson_editions_bundles)) {
                $idx = 0;
                foreach ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles as $validBundle) {
                    if ($validBundle->lesson_editions_bundle->lesson_id == $lesson_edition->lesson_id) {
                        $validBundleIndex = $idx;
                    }
                    $idx++;
                }

                if (isset($validBundleIndex)) {
                    switch ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->status) {
                            case 1:
                                //set status to activated 2, decrease counter and set dates
                                $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->count = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->count -1;
                                $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->status = Configure::read('purchased_lesson_editions_bundle_statuses')['activated'];
                                $bundlesTable = $this->loadModel('LessonEditionsBundles');
                                $bundle = $bundlesTable->get($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->lesson_editions_bundle_id);
                                $now = Time::now();
                                $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->start_date = $now;
                                $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->end_date = $now->modify('+ '.$bundle->duration.' days');
                            break;

                            case 2:
                                //decrease counter, if becomes 0, set status as exhausted
                                $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->count = $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->count -1;
                                if ($lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->count == 0) {
                                    $lesson_edition->athlete->valid_purchased_lesson_editions_bundles[$validBundleIndex]->status = Configure::read('purchased_lesson_editions_bundle_statuses')['exhausted'];
                                }
                            break;

                    }
                }   
            }
            
            //debug($lesson_edition->athlete->purchased_lesson_editions_bundles);
            //debug($lesson_edition->athlete->valid_purchased_lesson_editions_bundles);
            
            if ($this->LessonEditions->save($lesson_edition, ['associated' => ['Athletes.ValidPurchasedLessonEditionsBundles']])) {
                $this->Flash->success(__('The lesson edition has been marked as completed.'));
                return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
            }
            
            
            

            //$this->Flash->error(__('The lesson edition could not be updated. Please, try again.'));
            //$this->set('errors', $lesson_edition->getErrors()); 
                     
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
            'contain' => ['Lessons', 'LessonEditionStatuses', 'Users', 'Athletes']
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

}
