<?php

?>

<div class="content">
	<h3><?= __('Attività') ?></h3>
	<div class="text-right"><?= $this->Html->link(__('Definisci una nuova Attività'), ['controller' => 'Activities', 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?></div>
	<div class="row">
		<div class="col">
			<h5><?= __('Attività in programma') ?></h5>
			<?php if(!$upcomingActivities->isEmpty()) : ?>
				<table class="table table-condensed table-striped">
					<thead>
						<th><?= __('Id') ?></th>
						<th><?= __('Tipo') ?></th>
						<th><?= __('Data') ?></th>
					</thead>
					<tbody>
					<?php foreach($upcomingActivities as $activity) : ?>
						<tr>
							<td><?= $this->Html->link($activity->id . ' - ' . $activity->event->title, ['controller' => 'Activities', 'action' => 'view', $activity->id])  ?></td>
							<td><?= h($activity->activity_type->name) ?></td>
							<td><?= h($activity->event->start_date) ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<div class="alert alert-info"><?= __('Nessuna attività in programma... Che non state a fa un ca**o?') ?></div>
			<?php endif; ?>
		</div>
		<div class="col">
			<h5><?= __('Attività da completare') ?></h5>
			<?php if(!$expiredScheduledActivities->isEmpty()) : ?>
				<table class="table table-condensed table-striped">
					<thead>
						<th><?= __('Attività') ?></th>
						<th><?= __('Tipo') ?></th>
						<th><?= __('Data') ?></th>
					</thead>
					<tbody>
					<?php foreach($expiredScheduledActivities as $activity) : ?>
						<tr>
							<td><?= $this->Html->link($activity->id . ' - ' . $activity->event->title, ['controller' => 'Activities', 'action' => 'view', $activity->id])  ?></td>
							<td><?= h($activity->activity_type->name) ?></td>
							<td><?= h($activity->event->start_date) ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<div class="alert alert-info"><?= __('Nessuna attività da completare... Così deve essere!') ?></div>
			<?php endif; ?>
		</div>
	</div>
	<hr>
	<h3><?= __('Lezioni') ?></h3>
	<div class="text-right"><?= $this->Html->link(__('Fissa una nuova Lezione Individuale'), ['controller' => 'LessonEditions', 'action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?></div>
	<div class="row">
		<div class="col">
			<h5>Programmate</h5>
			<?php if(!$upcomingLessonEditions->isEmpty()) : ?>
				<table class="table table-condensed table-striped">
					<thead>
						<th><?= __('Lezione') ?></th>
						<th><?= __('Atleta') ?></th>
						<th><?= __('Data') ?></th>
					</thead>
					<tbody>
					<?php foreach($upcomingLessonEditions as $lesson_edition) : ?>
						<tr>
							<td><?= $this->Html->link($lesson_edition->id . ' - ' . $lesson_edition->lesson->name, ['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id])  ?></td>
							<td><?= $this->Html->link($lesson_edition->athlete->name.' '.$lesson_edition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete_id]) ?></td>
							<td><?= h($lesson_edition->event->start_date) ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<div class="alert alert-info"><?= __('Nessuna Lezione in programma, non è bello.') ?></div>
			<?php endif; ?>
		</div>
		<div class="col">
			<h5>Da Completare</h5>
			<?php if(!$expiredBookedLessonEditions->isEmpty()) : ?>
				<table class="table table-condensed table-striped">
					<thead>
						<th><?= __('Lezione') ?></th>
						<th><?= __('Atleta') ?></th>
						<th><?= __('Data') ?></th>
					</thead>
					<tbody>
					<?php foreach($expiredBookedLessonEditions as $lesson_edition) : ?>
						<tr>
							<td><?= $this->Html->link($lesson_edition->id . ' - ' . $lesson_edition->lesson->name, ['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id])  ?></td>
							<td><?= $this->Html->link($lesson_edition->athlete->name.' '.$lesson_edition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete_id]) ?></td>
							<td><?= h($lesson_edition->event->start_date) ?></td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else : ?>
				<div class="alert alert-info"><?= __('Nessuna Lezione da completare, ottimo lavoro!') ?></div>
			<?php endif; ?>
		</div>
	</div>
</div>