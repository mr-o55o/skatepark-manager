<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');

?>
<div class="lessonEditions content">
	<ul class="nav justify-content-center">
		<li class="nav-item p-2"><?= $this->Html->link(__('Wizard Lezioni Individuali'), ['controller' => 'LessonEditions', 'action' => 'wizard'], ['class' => 'btn btn-primary']) ?></li>
	</ul>
	<hr>

	<?php

		foreach ($events as $event) {
			$content = '<strong>'.$event->start_date->i18nFormat('HH:mm').' - '.$event->end_date->i18nFormat('HH:mm').': </strong>';
			$class = '';
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
			$this->Calendar->addRow($event->start_date, $content, ['class' => 'event '.$class]);
		}
		echo $this->Calendar->render();
	?>
	<?php if (!$this->Calendar->isCurrentMonth()) { ?>
		<?php echo $this->Html->link(__('Go to current month'), ['action' => 'calendar'])?>
	<?php } ?>
</div>

