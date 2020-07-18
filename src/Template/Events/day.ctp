<?php

$previous_day = $current_day->modify('-1 day');
$next_day = $current_day->modify('+1 day');
?>
<h3><?= __('Eventi di') ?> <?= $current_day->i18nFormat('EEEE d MMMM Y'); ?></h3>
<div class="text-center">
	<?= $this->Html->link(__('Giorno Precedente'), ['action' => 'day', $previous_day->year . '-' . $previous_day->month . '-' . $previous_day->day] ) ?> 
	<?= $this->Html->link(__('Giorno Successivo'), ['action' => 'day', $next_day->year . '-' . $next_day->month . '-' . $next_day->day] ) ?>
</div>

<?php if(!empty($events)) : ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th><?= __('Orario') ?></th>
				<th><?= __('Titolo Evento') ?></th>
				<th><?= __('Dettagli')?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($events as $event) : ?>
			<tr>
				<td><?= $event->start_date->i18nFormat('HH:mm') ?> - <?= $event->end_date->i18nFormat('HH:mm') ?></td>
				<td><?= $event->title ?></td>
				<td>
					<?php if ($event->has('lesson_edition')) : ?>
						<strong><?= h($event->lesson_edition->lesson->name) ?></strong>
						<ul>
							<?php if ($event->lesson_edition->has('user')) : ?>
								<li><i><?= __('Istruttore') ?></i>: <?= $event->lesson_edition->user->username ?></li>
							<?php endif; ?>
							<?php if ($event->lesson_edition->has('athlete')) : ?>
								<li><i><?= __('Atleta') ?></i>: <?= $event->lesson_edition->athlete->name . ' ' . $event->lesson_edition->athlete->surname ?></li>
							<?php endif; ?>
							<li><i><?= __('Status') ?></i>: <?= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $event->lesson_edition->lesson_edition_status_id]); ?></li>
							<li><i><?= __('Note')?></i>: <?= $event->lesson_edition->notes ?></li>
						</ul>
						<?=$this->Html->link(__('Gestisci Edizione'), ['controller' => 'LessonEditions', 'action' => 'view', $event->lesson_edition->id], ['class' => 'btn btn-primary']) ?>
					<?php endif; ?>
					<?php if ($event->has('activity')) : ?>
						<strong><?= h($event->activity->activity_type->name) ?></strong>
						
						<ul>
							<?php if (count($event->activity->activity_users) > 0) : ?>
								<li><i><?= __('Staff') ?></i>:
									<ul>

									<?php foreach($event->activity->activity_users as $activity_user) : ?>
										<li><?= h($activity_user->user->username) ?> - <?= h($activity_user->task) ?></li>
									<?php endforeach; ?>
									</ul>
								</li>
							<?php endif; ?>
							<li><i><?= __('Status') ?></i>: <?= $this->element('ActivityStatuses/status-badge', ['statusId' => $event->activity->activity_status_id]); ?></li>
							<li><i><?= __('Note')?></i>: <?= $event->activity->notes ?></li>
						</ul>
						<?=$this->Html->link(__('Gestisci Attività'), ['controller' => 'Activities', 'action' => 'view', $event->activity->id], ['class' => 'btn btn-primary']) ?>					
					<?php endif; ?>
				</td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php else : ?>
	<div class="alert alert-waring"><?= __('Non sono previsti eventi nella giornata.') ?></div>
<?php endif; ?>	
<?= $this->Html->link(__('Back'), $back_url)?>