<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');

?>
<div class="lessonEditions content">
	<ul class="nav justify-content-center">
		<li class="nav-item p-2"><?= $this->Html->link(__('Pianifica una nuova Attività'), ['controller' => 'Activities', 'action' => 'add'], ['class' => 'btn btn-primary']) ?></li>
	</ul>
	<hr>
	<p class="text-center">
		<span class="badge event-lesson-edition">Lezione Individuale</span> 
		<span class="badge event-activity">Attività</span>
		<span class="badge event-course-session">Corso</span>
	</p>


	<?php

		foreach ($events as $event) {
			$content = '<strong>'.$event->start_date->i18nFormat('HH:mm').' - '.$event->end_date->i18nFormat('HH:mm').': </strong>';
			//Activity Event
			if ($event->activity) {
				$content .= $this->Html->link($event->activity->activity_type->name.' - '.$event->title, ['controller' => 'activities', 'action' => 'view', $event->activity->id]).'<br>';

				if (count($event->activity->activity_users) > 0) {
					foreach($event->activity->activity_users as $activity_user) {
						$content .= $activity_user->user->username .' ';
					}
					//$content .= $event->activity->activity_users[0]->user->username.'<br>';
				}
				$content .= $this->element('ActivityStatuses/status-badge', ['statusId' => $event->activity->activity_status_id]);
				$class = 'event-activity';
			}
			//Lesson Edition Event
			if ($event->lesson_edition) {
				$content .= $this->Html->link($event->lesson_edition->lesson->name, ['controller' => 'LessonEditions', 'action' => 'view', $event->lesson_edition->id]).'<br>';
				if ($event->lesson_edition->user) {
					$content .= ' <b>'.$event->lesson_edition->user->username.'</b>';	
				}
				if ($event->lesson_edition->athlete) {
					$content .= ' con <b>'.$event->lesson_edition->athlete->name.' '.$event->lesson_edition->athlete->surname.'</b>';
				}
				$content .= ' '.$this->element('LessonEditionStatuses/status-badge', ['statusId' => $event->lesson_edition->lesson_edition_status_id]);
				$class = 'event-lesson-edition';
			}
			//Course Session Event
			if ($event->course_session) {
				$content .= $this->Html->link(h($event->title), ['controller' => 'CourseSessions', 'action' => 'View', $event->course_session->id]).' '.$this->element('CourseSessionStatuses/status-badge', ['statusId' => $event->course_session->course_session_status_id]).'<br>';
				$content .= __('Istruttori assegnati:') . ' ' . count($event->course_session->course_session_trainers).'<br>';
				$class = 'event-course-session';
			}
			$this->Calendar->addRow($event->start_date, $content, ['class' => 'event '.$class]);
		}
		echo $this->Calendar->render();
	?>
	<?php if (!$this->Calendar->isCurrentMonth()) { ?>
		<?php echo $this->Html->link(__('Go to current month'), ['action' => 'calendar'])?>
	<?php } ?>
</div>

