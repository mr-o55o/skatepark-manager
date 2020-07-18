<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\I18n\FrozenDate;
use Cake\I18n\Time;

/**
 * Events Controller
 *
 * @property \App\Model\Table\EventsTable $Events
 *
 * @method \App\Model\Entity\Event[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EventsController extends AppController
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
            'contain' => ['LessonEditions', 'Activities']
        ];
        $events = $this->paginate($this->Events);

        $this->set(compact('events'));
    }

    /**
     * @param string|null $year
     * @param string|null $month
     * @return void
     */
    public function courseSessionsCalendar($year = null, $month = null) {
        $this->Calendar->init($year, $month);
        /*
        $passedBookedLessonEditions = $this->Events->lessonEditions->find('booked')->contain(['Events'])->where(['Events.end_date <' => Time::now()]);
        if ($passedBookedLessonEditions->count() > 0) {
            $this->Flash->warning('There are booked lesson editions in the past, you should check them.');
        }
        */
        $options = [
            'year' => $this->Calendar->year(),
            'month' => $this->Calendar->month(),
            'contain' => [
                'CourseSessions.CourseSessionTrainers.Users', 
            ], 
        ];
        $events = $this->Events->find('calendar', $options);
        $events->join([
        'table' => 'course_sessions',
        'alias' => 'cs',
        'type' => 'RIGHT',
        'conditions' => 'cs.event_id = events.id',
    ]);
        $events->order(['start_date']);
        //debug($events->toArray());

        //$this->viewBuilder()->setLayout('private');
        $this->set(compact('events')); 
    }

    /**
     * @param string|null $year
     * @param string|null $month
     * @return void
     */
    public function lessonEditionsCalendar($year = null, $month = null) {
        $this->Calendar->init($year, $month);
        /*
        $passedBookedLessonEditions = $this->Events->lessonEditions->find('booked')->contain(['Events'])->where(['Events.end_date <' => Time::now()]);
        if ($passedBookedLessonEditions->count() > 0) {
            $this->Flash->warning('There are booked lesson editions in the past, you should check them.');
        }
        */
        $options = [
            'year' => $this->Calendar->year(),
            'month' => $this->Calendar->month(),
            'contain' => [
                'LessonEditions.Lessons', 
                'LessonEditions.Athletes', 
                'LessonEditions.Users',
            ], 
        ];
        $events = $this->Events->find('calendar', $options);
        $events->join([
        'table' => 'lesson_editions',
        'alias' => 'le',
        'type' => 'RIGHT',
        'conditions' => 'le.event_id = events.id',
    ]);
        $events->order(['start_date']);
        //debug($events->toArray());

        //$this->viewBuilder()->setLayout('private');
        $this->set(compact('events')); 
    }

    /**
     * @param string|null $year
     * @param string|null $month
     * @return void
     */
    public function activitiesCalendar($year = null, $month = null) {
        $this->Calendar->init($year, $month);
        /*
        $passedBookedLessonEditions = $this->Events->lessonEditions->find('booked')->contain(['Events'])->where(['Events.end_date <' => Time::now()]);
        if ($passedBookedLessonEditions->count() > 0) {
            $this->Flash->warning('There are booked lesson editions in the past, you should check them.');
        }
        */
        $options = [
            'year' => $this->Calendar->year(),
            'month' => $this->Calendar->month(),
            'contain' => [
                'Activities.ActivityTypes', 
                'Activities.ActivityUsers.Users', 
            ], 
        ];
        $events = $this->Events->find('calendar', $options);
        $events->join([
        'table' => 'activities',
        'alias' => 'a',
        'type' => 'RIGHT',
        'conditions' => 'a.event_id = events.id',
    ]);
        $events->order(['start_date']);
        //debug($events->toArray());

        //$this->viewBuilder()->setLayout('private');
        $this->set(compact('events')); 
    }


    /**
     * @param string|null $year
     * @param string|null $month
     * @return void
     */
    public function calendar($year = null, $month = null) {
        $this->Calendar->init($year, $month);
        /*
        $passedBookedLessonEditions = $this->Events->lessonEditions->find('booked')->contain(['Events'])->where(['Events.end_date <' => Time::now()]);
        if ($passedBookedLessonEditions->count() > 0) {
            $this->Flash->warning('There are booked lesson editions in the past, you should check them.');
        }
        */
        $options = [
            'year' => $this->Calendar->year(),
            'month' => $this->Calendar->month(),
            'contain' => [
                'Activities.ActivityTypes', 
                'Activities.ActivityUsers.Users', 
                'LessonEditions.Lessons', 
                'LessonEditions.Athletes', 
                'LessonEditions.Users',
                'CourseSessions.CourseSessionTrainers.Users',
                //'CourseSessions.Courses.CourseSubscriptions',
                //'Courses',
            ],
            
            'joins' => [
                //Activities
                [
                    'table' => 'activities',
                    'alias' => 'Activities',
                    'type' => 'LEFT',
                    'conditions' => [
                        'activities.event_id = events.id'
                    ]
                ],
                //ActivityTypes
                [
                    'table' => 'activity_types',
                    'alias' => 'ActivityTypes',
                    'type' => 'LEFT',
                    'conditions' => [
                        'activities.activity_type_id = activity_types.id'
                    ]
                ],
                //LessonEditions
                [
                    'table' => 'lesson_editions',
                    'alias' => 'LessonEditions',
                    'type' => 'LEFT',
                    'conditions' => [
                        'lesson_editions.event_id = events.id'
                    ]
                ],
                //Lessons
                 [
                    'table' => 'lessons',
                    'alias' => 'Lessons',
                    'type' => 'LEFT',
                    'conditions' => [
                        'lesson_editions.lesson_id = lessons.id'
                    ]
                ],
                //CourseSessions
                [
                    'table' => 'course_sessions',
                    'alias' => 'CourseSessions',
                    'type' => 'LEFT',
                    'conditions' => [
                        'course_sessions.event_id = events.id'
                    ]
                ],
                //CourseSessionTrainers
                [
                    'table' => 'course_sessions_trainers',
                    'alias' => 'CourseSessionsTrainers',
                    'type' => 'LEFT',
                    'conditions' => [
                        'course_sessions_trainers.course_session_id = course_sessions.id'
                    ]
                ], 


                //Courses
                /*
                [
                    'table' => 'course_sessions.courses',
                    'alias' => 'Courses',
                    'type' => 'LEFT',
                    'conditions' => [
                        'course_sessions.course_id = course.id'
                    ]
                    
                ],

                //CourseSubscriptions
                [
                    'table' => 'course_sessions.course.course_subscriptions',
                    'alias' => 'CourseSubscriptions',
                    'type' => 'LEFT',
                    'conditions' => [
                        'course_subscriptions.course_id = course.id'
                    ]
                ]
                */                                             
            ],
            
        ];
        $events = $this->Events->find('calendar', $options)->order(['start_date']);
        //debug($events->toArray());

        $this->viewBuilder()->setLayout('private');
        $this->set(compact('events'));
    }

    public function weeklyCalendar($string_date = null) {
        $current_day = new FrozenDate($string_date);

        $monday = $current_day->startOfWeek();
        $sunday = $current_day->endOfWeek();
        //debug($monday);
        //debug($sunday);
        $events = $this->Events->find('between', ['from' => $monday, 'to' => $sunday]);
        $this->set('events', $events);

    }

    public function day($string_date = null) {

        $current_day = new FrozenDate($string_date);

        $events = $this->Events->find('inDay', ['day' => $current_day])->contain(['LessonEditions.Users', 'LessonEditions.Lessons']);
        $this->set('events', $events);
        $this->set('back_url', $this->referer());
        $this->set('current_day', $current_day);
    }


/*
    public function addLessonEditionEvent() {

        $session = $this->getRequest()->getSession();
        $eventEntity = $session->consume('event');

        if(!$eventEnity->lesson_editionition->user) {
            $session->write('event', $eventEntity);
            $this->serAction('selectTrainer');
        }

        if(!$eventEnity->lesson_editionition->athlete) {
            $session->write('event', $eventEntity);
            $this->serAction('selectAthlete');
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            //to-do: check that event data are acceptable

            $event = $this->Events->patchEntity($event, $this->request->getData());
            //get lesson data
            $lesson = TableRegistry::getTableLocator()->get('Lessons')->get($event->lesson_edition->lesson_id);
            //set event end date based on lesson duration
            $event->end_date = $event->start_date->modify('+ '.$lesson->duration.' minutes');
            //attach lesson
            $event->lesson_edition->lesson = $lesson;
            //set lesson edition status to draft
            $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['draft'];
            //set event title to lesson name
            $event->title = $lesson->name;
            
            //save event and lesson edition
            debug($event);

            //redirect to trainer selection
            //$this->setAction('calendar');
        }
        $lessons = TableRegistry::getTableLocator()->get('Lessons')->find('list', ['limit' => 200]);
        $this->set(compact('event','lessons'));
        //$session = $this->getRequest()->getSession();
        //$session->write('event', $event);      
    }
*/
/*
    public function selectLessonType() {

    }
*/
     /* Select Trainer Method
     *
     *
     */
/*
    public function selectTrainer()
    {
        //debug($this->request->referer());
        $user = TableRegistry::getTableLocator()->get('Users')->newEntity();
        $session = $this->getRequest()->getSession();
        $event = $session->consume('event');

        if (!$event) {
            //if no event in session then go to calendar, this method is not meant to be used directly
            $this->Flash->error(__('Event data not found'));
            return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            //populate event.lesson_edition entity with user data if a user was selected
            //$user = $this->
            if ($this->request->getData('user_id')) {
                $user = $this->Users->get($this->request->getData('user_id'));
                if (!$user) {
                    $this->Flash->error(__('Selected trainer is not valid.'));
                    return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
                }
                //add trainer to lesson_edition
                $event->lesson_edition->user = $user;
            }
            //save event in session
            $session = $this->getRequest()->getSession();
            $session->write('event', $event);
            return($this->redirect($this->request->referer()));
        }
         
        $trainers = TableRegistry::getTableLocator()->get('Users')->find('freeTrainers', ['start_date' => $event->start_date, 'end_date' => $event->end_date])->find('list');
        $this->set(compact('event', 'trainers', 'user'));
        $session = $this->getRequest()->getSession(); 
        $session->write('event', $event);       
    } 
*/
/*
    public function selectStartDate()
    {

    }
*/
/*
    public function saveLessonEditionEvent()
    {
        $session = $this->getRequest()->getSession();
        $event = $session->consume('event');

        if (!$event) {
            $this->Flash->error(__('Event data not found'));
            return($this->redirect(['controller' => 'Events', 'action' => 'calendar']));
        }

        if ($this->request->is(['patch', 'post', 'put'])) {

            //if lesson has a trainer and an athlete set status to booked else set status to draft
            if ($event->lesson_edition->athlete && $event->lesson_edition->user) {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['booked'];
            } else {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['scheduled'];
            }

            $event->lesson_edition->notes = $this->request->getData('lesson_edition_notes');

            if ($this->Events->save($event)) {
                $this->Flash->success(__('Event has been saved'));
            } else {
                $this->Flash->error(__('Event could not be saved'));
            }
            $session->delete('event');
            return($this->redirect(['controller' => 'Events', 'action' => 'calendar']));
        }
        $session->write('event', $event);
        $this->set(compact('event'));        
    }

*/

    /**
     * Add Lesson Edition method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*
    public function addLessonEditionEvent()
    {
        $event = $this->Events->newEntity(['associated' =>  ['LessonEditions']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            $event = $this->Events->patchEntity($event, $this->request->getData(), [
                'contain' => ['LessonEditions'],
            ]);
            $lesson = TableRegistry::getTableLocator()->get('Lessons')->get($event->lesson_edition->lesson_id);

            // set status to scheduled
            // if there is an athlete and a user: set status as booked, else set as scheduled
            if ($event->lesson_edition->athlete_id && $event->lesson_edition->user_id) {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['booked'];
            } else {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['scheduled'];
            }
            
            // set event fk
            //$lessonEdition->event_id = $lessonEdition->event->id;
            // set event title
            $event->title = $lesson->name;
            // set event end_date
            $event->end_date = $event->start_date->modify('+ '.$lesson->duration.'minutes');

            //debug($event);
            
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The lesson edition has been added.'));
                return $this->redirect(['controller' => 'Events', 'action' => 'viewLessonEditionEvent', $event->id]);
            }
            $this->Flash->error(__('The lesson edition could not be added. Please, try again.'));
            $this->set('errors', $event->getErrors());
        }

        $lessons = TableRegistry::getTableLocator()->get('Lessons')->find('list', ['limit' => 200]);
        $this->set(compact('event', 'lessons')); 
    }
    */

    /**
     * View Lesson Edition method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
/*
    public function viewLessonEditionEvent($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['LessonEditions', 'LessonEditions.Lessons', 'LessonEditions.Users', 'LessonEditions.Athletes', 'LessonEditions.LessonEditionStatuses']
        ]);
        $this->set('event', $event);
    }
*/

    /**
     * Edit Lesson Edition method
     *
     * @param string|null $id Lesson Edition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
/*
    public function editLessonEditionEvent($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['LessonEditions', 'LessonEditions.Users', 'LessonEditions.Athletes']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $event = $this->Events->patchEntity($event, $this->request->getData());

            // set status to scheduled
            // if there is an athlete and a user: set status as booked, else set as scheduled
            if ($event->lesson_edition->athlete_id && $event->lesson_edition->user_id) {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['booked'];
            } else {
                $event->lesson_edition->lesson_edition_status_id = Configure::read('lesson_edition_statuses')['scheduled'];
            }

            
            if ($this->Events->save($event)) {
                $this->Flash->success(__('The lesson edition event has been updated.'));

                return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
            }
            $this->Flash->error(__('The lesson edition event could not be saved. Please, try again.'));
            
        }
        $lessons = TableRegistry::getTableLocator()->get('Lessons')->find('list', ['limit' => 200]);
        $lessonEditionStatuses = TableRegistry::getTableLocator()->get('LessonEditionStatuses')->find('list', ['limit' => 200]);
        //$athletes = $this->LessonEditions->Athletes->find('list', ['limit' => 200]);
        $this->set(compact('event', 'lessons', 'lessonEditionStatuses'));
    }
*/


    /**
     * Add Activity Event method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
/*

    public function addActivityEvent()
    {
        $event = $this->Events->newEntity(['associated' =>  ['Activities']]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            debug($this->request->getData());
            $duration = $this->request->getData('duration');
            $event = $this->Events->patchEntity($event, $this->request->getData(), [
                'contain' => ['Activities'],
            ]);
            
            $activity_type = TableRegistry::getTableLocator()->get('ActivityTypes')->get($event->activity->activity_type_id);


            // set event fk
            //$lessonEdition->event_id = $lessonEdition->event->id;
            // set event title
            $event->title = $activity_type->name;
            // set event end_date
            $event->end_date = $event->start_date->modify('+ '.$duration.'hours');

            
            debug($event);
            if ($this->Events->save($event)) {
                $this->Flash->success(__('Activity has been added.'));
                return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
            }
            $this->Flash->error(__('Activity could not be added. Please, try again.'));
            $this->set('errors', $event->getErrors());
            
        }

        $activity_types = TableRegistry::getTableLocator()->get('ActivityTypes')->find('list', ['limit' => 200]);
        $this->set(compact('event', 'activity_types')); 
    }
*/

     /**
     * View Activity Event method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */ 
/*  
    public function viewActivityEvent($id = null)
    {
        $event = $this->Events->get($id, [
            'contain' => ['Activities', 'Activities.Users', 'Activities.ActivityTypes']
        ]);
        $this->set('event', $event);
    }
*/
     /**
     * Edit Activity Event method
     *
     * @param string|null $id Lesson Edition id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
/*
     public function editActivityEvent($id = null) {
        $event = $this->Events->get($id, [
            'contain' => ['Activities', 'Activities.Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $event = $this->Events->patchEntity($event, $this->request->getData());

            if ($this->Events->save($event)) {
                $this->Flash->success(__('Activity event has been updated.'));

                return $this->redirect(['controller' => 'Events', 'action' => 'calendar']);
            }
            $this->Flash->error(__('Activity event could not be saved. Please, try again.'));
            
        }
        $activity_types = TableRegistry::getTableLocator()->get('ActivityTypes')->find('list', ['limit' => 200]);
        $lessonEditionStatuses = TableRegistry::getTableLocator()->get('LessonEditionStatuses')->find('list', ['limit' => 200]);
        //$athletes = $this->LessonEditions->Athletes->find('list', ['limit' => 200]);
        $this->set(compact('event', 'activity_types'));        
     } 
*/ 
 

    /**
     * Delete method
     *
     * @param string|null $id Event id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
/*
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $event = $this->Events->get($id);
        debug($event);
        if ($this->Events->delete($event)) {
            $this->Flash->success(__('The event has been deleted.'));
        } else {
            $this->Flash->error(__('The event could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'calendar']);
    }
*/

}
