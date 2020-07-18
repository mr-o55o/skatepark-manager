<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;
use Cake\Core\Configure;

/**
 * Courses Controller
 *
 * @property \App\Model\Table\CoursesTable $Users
 *
 * @method \App\Model\Entity\Course[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CoursesController extends AppController
{

    

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CourseStatuses']
        ];
        $query = $this->Courses->find('all')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    public function indexDraft()
    {
        $this->paginate = [
            'contain' => ['CourseStatuses']
        ];
        $query = $this->Courses->find('draft')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    public function indexScheduled()
    {
        $this->paginate = [
            'contain' => ['CourseLevels']
        ];
        $query = $this->Courses->find('scheduled')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    public function indexActive()
    {
        $this->paginate = [
            'contain' => ['CourseLevels']
        ];
        $query = $this->Courses->find('active')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    public function indexCompleted()
    {
        $this->paginate = [
            'contain' => ['CourseLevels']
        ];
        $query = $this->Courses->find('completed')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    public function indexCancelled()
    {
        $this->paginate = [
            'contain' => ['CourseLevels']
        ];
        $query = $this->Courses->find('cancelled')->order(['start_date' => 'DESC']);

        $this->set('courses', $this->paginate($query));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $course = $this->Courses->newEntity();

        if ($this->request->is('post')) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            //debug($course);
            //set status to activated
            $course->course_status_id = 1;
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The new course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The new course could not be saved. Please, try again.'));
            
        }
        $this->set(compact('course'));
    }

    /**
     * Delete method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $course = $this->Courses->get($id);

        if ($course->course_status_id <> Configure::read('course_statuses')['draft']) {
            $this->Flash->error(__('Non è possibile eliminare un corso che non è in bozza'));
            $this->redirect(['action' => 'view', $course->id]);
        }


        if ($this->Courses->delete($course, ['associated' => ['CourseSessions.Events', 'CoursesSubscriptions', 'CourseSessions.CourseSessionPartecupants' ]])) {
            $this->Flash->success(__('Corso eliminato.'));
        } else {
            $this->Flash->error(__('Errore durante la cancellazione.'));
        }

        return $this->redirect(['action' => 'indexScheduled']);
    }

    /**
     * View method
     *
     * @param string|null $id course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course = $this->Courses->get($id, [
            'contain' => [
                'CourseStatuses', 
                'CourseSubscriptions.Subscriptions.Athletes',
                'CourseSubscriptions.Subscriptions.SubscriptionTypes', 
                'CourseSubscriptions.Subscriptions.SelectedCourseEditions.CourseEditions',

                ]
            ]);
        $this->set('course', $course);
    }

    /**
     * Edit method
     *
     * @param string|null $id course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $course = $this->Courses->get($id, [ 'contain' => ['CourseLevels', 'CourseStatuses'] ]);
        //debug($course->course_status_id);
        if ($course->course_status_id <> 1 ) {
        	$this->Flash->error(__('This course cannot be edited.'));
        	return $this->redirect(['action' => 'view', $course->id]);        	
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $course = $this->Courses->patchEntity($course, $this->request->getData());
            //debug($course);
            //set status to activated
            //$course->course_status_id = 1;
            if ($this->Courses->save($course)) {
                $this->Flash->success(__('The new course has been saved.'));

                return $this->redirect(['action' => 'view', $course->id]);
            }
            $this->Flash->error(__('The new course could not be saved. Please, try again.'));
        }        
        $courseLevels = $this->Courses->CourseLevels->find('list', ['limit' => 200]);
        $this->set(compact('course', 'courseLevels'));
    }

    /**
     * Schedule method
     *
     * @param string|null $id course id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function schedule($id = null)
    {
        $course = $this->Courses->get($id, [ 'contain' => ['CourseLevels', 'CourseStatuses', 'CourseSessions.Events'] ]);

        if (count($course->course_sessions) > 0) {
        	$this->Flash->error(__('This course cannot be sheduled.'));
        	return $this->redirect(['action' => 'view', $course->id]); 
        }
        if ($this->request->is('post')) {
        	$current_date = $course->start_date;
        	while ($current_date <= $course->end_date) {
        		
        		if (in_array($current_date->dayOfWeek, $course->week_days, false)) {
        			//set event start_date
        			$event_start_date = Chronos::create(
        				$current_date->year, 
        				$current_date->month, 
        				$current_date->day, 
        				$course->start_time->hour, 
        				$course->start_time->minute
        			);
        			//set event end date
        			$event_end_date =  Chronos::create(
        				$current_date->year, 
        				$current_date->month, 
        				$current_date->day, 
        				$course->start_time->hour, 
        				$course->start_time->minute)
        				->addMinutes($course->duration)
        			;
        			//create & populate event entity
        			$event = $this->Courses->CourseSessions->Events->newEntity();
        			$event->title = 'Corso: ' . $course->name;
        			$event->start_date = $event_start_date; 
        			$event->end_date = $event_end_date;
        			//create & populate course session entity
        			$course_session = $this->Courses->CourseSessions->newEntity(['associated' => 'Events']);
        			$course_session->event = $event;
        			$course_session->course_id = $course->id;
        			$course_session->course_session_status_id = 1;

        			//attach course_session to course entity
        			$course->course_sessions[] = $course_session;

        		}
        		$current_date = $current_date->addDay(1);
        	}
        	$course->setDirty('course_sessions', true);
        	//set course status to scheduled
        	$course->course_status_id = 2;
        	
        	if ($this->Courses->save($course, ['associated' => ['CourseSessions', 'CourseSessions.Events']])) {
        		 $this->Flash->success(__('Course has been scheduled.'));
        	} else {
        		$this->Flash->error(__('Error during the schedule operation.'));
        	}
        	
        	//debug($course);
        }

        $this->set('course', $course);
    }

    /**
     * Activate method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function activate($id = null)
    {
        $this->request->allowMethod(['post']);
        $course = $this->Courses->get($id);

        if ($course->course_status_id <> Configure::read('course_statuses')['scheduled']) {
            $this->Flash->error(__('Invalid status for course activation'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $course->course_status_id = Configure::read('course_statuses')['active'];

        if ($this->Courses->save($course)) {
            $this->Flash->success(__('Course has been activated.'));
        } else {
            $this->Flash->error(__('Error activating course.<br>'.print_r($course->errors())));
        }
        
        return $this->redirect(['action' => 'view', $id]);

    }

    public function complete($id = null)
    {
        //$this->request->allowMethod(['post']);
        $course = $this->Courses->get($id);

        if (!$course->isCompletable()) {
            $this->Flash->error(__('Invalid status for course completion'));
            return $this->redirect(['action' => 'view', $id]);
        }

        $course->course_status_id = Configure::read('course_statuses')['completed'];

        if ($this->Courses->save($course)) {
            $this->Flash->success(__('Course has been marked as completed.'));
            return $this->redirect(['action' => 'view', $id]);
        } else {
            $this->Flash->error(__('Error completing course.'));
            $this->set('errors', $course->errors());
        }
        
        

    }

    public function changePaidStatus($id = null)
    {

    }
}