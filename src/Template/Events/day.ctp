<?php

?>
<h3><?= __('Events for') ?> <?= $current_day->i18nFormat('EEEE d MMMM Y'); ?></h3>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?= __('Event Time') ?></th>
			<th><?= __('Event Title') ?></th>
			<th><?= __('Event Details')?></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($events as $event) : ?>
		<tr>
			<td><?= $event->start_date->i18nFormat('HH:mm') ?> - <?= $event->end_date->i18nFormat('HH:mm') ?></td>
			<td><?= $event->title ?></td>
			<td>
				<?php if ($event->has('lesson_edition')) : ?>
					<ul>
						<li><i><?= __('Trainer') ?></i>: <?= $event->lesson_edition->user->username ?></li>
						<li><i><?= __('Athlete') ?></i>: <?= $event->lesson_edition->athlete->name . ' ' . $event->lesson_edition->athlete->surname ?></li>
						<li><i><?= __('Status') ?></i>: <?= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $event->lesson_edition->lesson_edition_status_id]); ?></li>
						<li><i><?= __('Notes')?></i>: <?= $event->lesson_edition->notes ?></li>
					</ul>
					<?=$this->Html->link(__('Manage this lesson edition event'), ['controller' => 'LessonEditions', 'action' => 'view', $event->lesson_edition->id], ['class' => 'btn btn-primary']) ?>
				<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>
<?= $this->Html->link(__('Back'), $back_url)?>