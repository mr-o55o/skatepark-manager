<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;


/**
 * LessonEditions Controller
 *
 * @property \App\Model\Table\LessonEditionsTable $LessonEditions
 *
 * @method \App\Model\Entity\LessonEdition[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LessonEditionWizardController extends AppController
{
	
	public $components = ['Wizard.Wizard'];
	public $uses = ['LessonEdition', 'Event'];


	function beforeFilter(Event $event) 
	{
		$this->Wizard->steps = ['selectLessonType', 'selectEventTime', 'searchAthlete', 'selectAthlete', 'selectTrainer', 'review'];
	}

	function wizard($step = null) {
		$this->Wizard->process($step);
	}

	/**
	 * [Wizard Prepare Callbacks]
	 */
	function _prepareSelectLessonType() {
		$lessons = TableRegistry::getTableLocator()->get('Lessons')->find('list');
		$this->set('lessons', $lessons);
	}

	function _prepareSelectEventTime() {
		$wizardData = $this->Wizard->read();
		$this->loadModel('Lessons');
		$selectedLesson = $this->Lessons->get($wizardData['selectLessonType']['lesson_id']);
		$this->set('selectedLesson', $selectedLesson);
	}

	/**
	 * [Wizard Process Callbacks]
	 */
	function _processSelectLessonType() {
		$lessonEditions = $this->loadModel('LessonEditions');
		$lesson_edition = $lessonEditions->patchEntity($lesson_edition, $this->request->getData(), ['associated' => 'Lessons']);
		//$lesson_edition->lesson_id = 1;
		$lesson_edition->lesson_edition_status_id = 1;
		debug($lesson_edition);
		
		if(!$lesson_edition->errors()) {
			return true;
		}
		return false;
		
	}

	function _processSelectEventTime() {
		$wizardData = $this->Wizard->read();

		debug($this->request->getData());

		$this->loadModel('Lessons');
		$selectedLesson = $this->Lessons->get($wizardData['selectLessonType']['lesson_id']);
		if (!$selectedLesson) {
			return false;
		}
		$this->loadModel('Events');
		$event = $this->Events->newEntity();
		$event = $this->Events->patchEntity($event, $this->request->getData());

		$event->title = $selectedLesson->name;
		$event->end_date = $event->start_date->modify('+ '.$selectedLesson->duration.' minutes');

		if(!$event->errors()) {
			$this->Wizard->save(null ,$event);
			return true;
		}
		
		return false;
	}

	/**
	 * [Wizard Completion Callback]
	 */
	function _afterComplete() {
		$wizardData = $this->Wizard->read();
		extract($wizardData);
		debug($wizardData);
		//$this->Client->save($account['Client'], false, array('first_name', 'last_name', 'phone'));
		//$this->User->save($account['User'], false, array('email', 'password'));
		
	}	 	



}
?>