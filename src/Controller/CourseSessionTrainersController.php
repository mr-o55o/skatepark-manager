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
class CourseSessionTrainersController extends AppController
{

	public function addTrainer($id = null) {
		$course_session_trainer = $this->CourseSessionTrainers->newEntity();

		$course_session = $this->CourseSessionTrainers->CourseSessions->get($id, ['contain' => 'Events']);

		//debug($course_session->event);
		if ($this->request->is('post')) {
			$course_session_trainer = $this->CourseSessionTrainers->patchEntity($course_session_trainer, $this->request->getData());
			$course_session_trainer->course_session = $course_session;
			if ($this->CourseSessionTrainers->save($course_session_trainer)) {
				$this->Flash->success('Trainer succesfully added to session');
			} else {
				$this->Flash->error('Error adding trainer to session');
			}
		}

		$exclude = $course_session->event->id;
		$available_trainers = $this->CourseSessionTrainers->Users->find('free', ['start_date' => $course_session->event->start_date, 'end_date' => $course_session->event->end_date, 'exclude' => null ])->where(['role_id' => 15])->find('list');

		$this->set('available_trainers', $available_trainers);
		$this->set('course_session', $course_session);
		$this->set('course_session_trainer', $course_session_trainer);
	}



}
?>
