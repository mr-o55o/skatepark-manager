<?php
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Http\Exception\ForbiddenException;
use Cake\Http\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;


/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class MonitoringController extends AppController
{

	public function index()
	{

		$now = Time::now();

		$upcomingLessonEditions = $this->paginate(
			TableRegistry::getTableLocator()->get('LessonEditions')
			->find('all', [
				'contain' => ['Events', 'Athletes', 'Lessons', 'LessonEditionStatuses']
			])
			->where(['events.start_date >=' => $now ])
			->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']])
		);

		$upcomingActivities = $this->paginate(
			TableRegistry::getTableLocator()->get('Activities')
			->find('all', [
				'contain' => ['Events', 'ActivityStatuses', 'ActivityTypes']
			])
			->where(['events.start_date >=' => $now ])
		);

		$expiredBookedLessonEditions = $this->paginate(
			TableRegistry::getTableLocator()->get('LessonEditions')
			->find('all', [
				'contain' => ['Events', 'Athletes', 'Lessons', 'LessonEditionStatuses']
			])
			->where(['events.end_date <' => $now ])
			->where(['lesson_edition_status_id' => Configure::read('lesson_edition_statuses')['booked']])
		);

		$expiredScheduledActivities = $this->paginate(
			TableRegistry::getTableLocator()->get('Activities')
			->find('all', [
				'contain' => ['Events', 'ActivityStatuses', 'ActivityTypes']
			])
			->where(['events.end_date <' => $now ])
			->where(['activity_status_id' => 2])
		);

		$this->set('upcomingLessonEditions', $upcomingLessonEditions);
		$this->set('upcomingActivities', $upcomingActivities);
		$this->set('expiredBookedLessonEditions', $expiredBookedLessonEditions);
		$this->set('expiredScheduledActivities', $expiredScheduledActivities);

	}
}
?>