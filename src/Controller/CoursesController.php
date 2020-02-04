<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;

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
            'contain' => ['CourseSessions', 'CourseLevels', 'CourseStatuses']
        ];
        $query = $this->Courses->find('all');

        $this->set('courses', $this->paginate($query));
    }

    public function indexDraft()
    {
        $this->paginate = [
            'contain' => ['CourseSessions', 'CourseLevels', 'CourseStatuses']
        ];
        $query = $this->Courses->find('draft');

        $this->set('courses', $this->paginate($query));
    }

    public function indexScheduled()
    {
        $this->paginate = [
            'contain' => ['CourseLevels', 'CourseStatuses', 'CourseSessions.CourseSessionTrainers']
        ];
        $query = $this->Courses->find('scheduled');

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
        $courseLevels = $this->Courses->CourseLevels->find('list', ['limit' => 200]);
        $this->set(compact('course', 'courseLevels'));
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
        $course = $this->Courses->get($id, [ 'contain' => ['CourseLevels', 'CourseStatuses', 'CourseSubscriptions.Athletes', 'CourseSessions.Events' => ['sort' => ['CourseSessions.id' => 'ASC']], 'CourseSessions.CourseSessionTrainers.Users', 'CourseSessions.CourseSessionStatuses'] ]);


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

}