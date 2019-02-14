<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');

?>
<div class="lessonEditions content">
    <h3>
        <?= __('Events Calendar') ?>
    </h3>
    <small><?= __('Events calendar displays the activity schedule of the park') ?></small>
    <hr>
    <?php echo $this->element('Events/events-menu'); ?>
    <hr>
	<?php
		foreach ($events as $event) {
			$content = '<strong>'.$event->start_date->i18nFormat('HH:mm').' - '.$event->end_date->i18nFormat('HH:mm').': </strong>';
			if ($event->activity) {
				$content .= $this->Html->link($event->title, ['action' => 'viewActivityEvent', $event->id]).'<br>';
				$content .= __('Member assigned').': '.($event->activity->user ? $event->activity->user->username : '-');
				
				$class = 'event-activity';
			} 
			if ($event->lesson_edition) {
				$content .= $this->Html->link($event->title, ['controller' => 'LessonEditions', 'action' => 'view', $event->lesson_edition->id]).'<br>';
				if ($event->lesson_edition->user) {
					$content .= __('Trainer').': '.$event->lesson_edition->user->username.'<br>';	
				}
				if ($event->lesson_edition->athlete) {
					$content .= __('Athlete').': '.$event->lesson_edition->athlete->name.' '.$event->lesson_edition->athlete->surname.'<br>';
				}
				/*
				if ($event->lesson_edition->notes != '') {
					$content .= '<small><strong>' . __('Notes') . '</strong></small>: <small>'. h($event->lesson_edition->notes) .'</small><br>';
				}
				*/
				$content .= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $event->lesson_edition->lesson_edition_status_id]);
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

