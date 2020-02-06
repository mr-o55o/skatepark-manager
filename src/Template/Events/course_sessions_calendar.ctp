<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');

?>
<div class="course-sessions-calendar content">
	<h3><?= __('Calendario delle Sessioni dei Corsi') ?></h3>
	<?php

		foreach ($events as $event) {
			$content = '<strong>'.$event->start_date->i18nFormat('HH:mm').' - '.$event->end_date->i18nFormat('HH:mm').': </strong>';
			$class = '';
			//Course Session Event
			if ($event->course_session) {
				$content .= $this->Html->link(h($event->title), ['controller' => 'CourseSessions', 'action' => 'View', $event->course_session->id]).' '.$this->element('CourseSessionStatuses/status-badge', ['statusId' => $event->course_session->course_session_status_id]).'<br>';
				$content .= __('Istruttori assegnati:') . ' ' . count($event->course_session->course_session_trainers).'<br>';
				$class = 'event-course-session';
			}
			$this->Calendar->addRow($event->start_date, $content, ['class' => 'event ']);
		}
		echo $this->Calendar->render();
	?>
	<?php if (!$this->Calendar->isCurrentMonth()) { ?>
		<?php echo $this->Html->link(__('Go to current month'), ['action' => 'calendar'])?>
	<?php } ?>
	<hr>
	<ul class="nav justify-content-center">
		<li class="nav-item p-2"><?= $this->Html->link(__('Pianifica nuovo Corso'), ['controller' => 'Courses', 'action' => 'add'], ['class' => 'btn btn-primary']) ?></li>
	</ul>
</div>

