<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Chronos\Chronos;

/**
 * CourseSessionPartecipants Controller
 *
 */
class CourseSessionPartecipantsController extends AppController
{

	public function add($course_session_id = null)
	{

		$course_session = $this->CourseSessionPartecipants->CourseSessions->get($course_session_id, ['contain' => ['Events', 'Courses.CourseLevels',]]);

		$partecipants = $this->CourseSessionPartecipants->find('all')->where(['course_session_id' => $course_session->id])->toArray();
		if (!empty($partecipants)) {
			$this->Flash->error('Presence data already exist for this session, cannot proceed.');
			return $this->redirect(['controller' => 'CourseSessions', 'action' => 'view', $course_session->id]);
		}

		$course_session_partecipants = $this->CourseSessionPartecipants->CourseSessions->Courses->CourseSubscriptions
			->find('all')
			->contain(['Athletes'])
			->where(['course_id' => $course_session->course_id]);	
		if ($this->request->is(['patch', 'post', 'put'])) {

			$course_session_partecipants = $this->CourseSessionPartecipants->newEntities($this->request->getData('CourseSessionPartecipants'));
			$result = $this->CourseSessionPartecipants->saveMany($course_session_partecipants);
			if ($result) {
				$this->Flash->success('Registry has been created.');
				
			} else {
				$this->Flash->error('Error saving the registry.');
			}
			return $this->redirect(['controller' => 'CourseSessions', 'action' => 'view', $course_session->id]);
		}

		$this->set('course_session', $course_session);
		$this->set('course_session_partecipants', $course_session_partecipants);
	}
}
?>