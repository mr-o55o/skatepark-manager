<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');

?>
<div class="lessonEditions content">
	<ul class="nav justify-content-center">
		<li class="nav-item p-2"><?= $this->Html->link(__('Pianifica una nuova Attività'), ['controller' => 'Activities', 'action' => 'add'], ['class' => 'btn btn-primary']) ?></li>
	</ul>
	<hr>
	<?php

		foreach ($events as $event) {
			$content = '<strong>'.$event->start_date->i18nFormat('HH:mm').' - '.$event->end_date->i18nFormat('HH:mm').': </strong>';
			//Activity Event
			$class= '';
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
			$this->Calendar->addRow($event->start_date, $content, ['class' => 'event '.$class]);
		}
		echo $this->Calendar->render();
	?>
	<?php if (!$this->Calendar->isCurrentMonth()) { ?>
		<?php echo $this->Html->link(__('Go to current month'), ['action' => 'calendar'])?>
	<?php } ?>
</div>

