<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;

/**
 * CourseSessions Controller
 *
 * @property \App\Model\Table\CoursesTable $Users
 *
 * @method \App\Model\Entity\CourseSession[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CourseSessionsController extends AppController
{


    /**
     * View method
     *
     * @param string|null $id course_session id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $course_session = $this->CourseSessions->get($id, [ 'contain' => ['Courses.CourseLevels', 'Events', 'CourseSessionTrainers.Users', 'CourseSessionStatuses'] ]);
        $this->set('course_session', $course_session);
    }

    /**
     * AddTrainer method
     *
     * @param string|null $id course_session id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */ 

 /*   
     public function addTrainer($id = null)
     {
        $course_session = $this->CourseSessions->get($id, [ 'contain' => ['Courses.CourseLevels', 'Events', 'CourseSessionTrainers', 'CourseSessionStatuses'] ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $course_session = $this->CourseSessions->patchEntity($course_session, $this->request->getData(), ['associated' => ['CourseSessionTrainers']]);
            
            debug($course_session->course_session_trainers);
            debug($course_session->errors());
            /*
            if ($this->CourseSessions->save($course_session, ['associated' => ['CourseSessionTrainers']])) {
                $this->Flash->success('Trainer successfully added to session.');
                //return $this->redirect(['action' => 'view', $course_session->id]);
            } else {
                $this->Flash->error('Error adding trainer to session.');
            }
            */
/*
        }
        $exclude = $course_session->event->id;
        $available_trainers = $this->CourseSessions->CourseSessionTrainers->Users->find('free', ['start_date' => $course_session->event->start_date, 'end_date' => $course_session->event->end_date, 'exclude' => $exclude ])->where(['role_id' => 15])->find('list');
        $this->set('course_session', $course_session);
        $this->set('available_trainers', $available_trainers);
     }  
*/ 
}
?>