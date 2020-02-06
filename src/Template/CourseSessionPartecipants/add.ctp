<?php 
$counter = 0;
?>

<h3><?= __('Corso') ?>  <?= h($course_session->course->name) ?> <?= h($course_session->course->course_level->name) ?> - <?= __('Registro presenze per la sessione del ') ?> <?= $course_session->event->start_date->i18nFormat('dd/MM/yyyy hh:mm') ?> [<?= $course_session->id ?>]</h3>

<?= $this->Html->link('Visualizza Sessione', ['controller' => 'CourseSessions', 'action' => 'view', $course_session->id], ['class' => 'btn btn-primary btn-sm']) ?>
<hr>
<?= $this->Form->create($course_session_partecipants) ?>
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				
				<th scope="col"><?= __('Atleta') ?></th>
				<th scope="col"><?= __('Presenza') ?></th>
				<th scope="col"><?= __('Noleggio Skate') ?></th>
				<th scope="col"><?= __('Noleggio Casco') ?></th>
				<th scope="col"><?= __('Noleggio Pads') ?></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($course_session_partecipants as $partecipant) : ?>
		<tr>
			<td><?= h($partecipant->athlete->name . ' '. $partecipant->athlete->surname) ?></td>
			<td>
				<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][athlete_id]', ['type' => 'hidden', 'value' => $partecipant->athlete_id]); ?>
				<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][is_present]', ['type' => 'checkbox', 'label' => '']); ?>
				<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][course_session_id]', ['type' => 'hidden', 'value' => $course_session->id]); ?>
			</td>
			<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_skateboard]', ['type' => 'checkbox', 'label' => '']); ?></td>
			<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_helmet]', ['type' => 'checkbox', 'label' => '']); ?></td>
			<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_pads]', ['type' => 'checkbox', 'label' => '']); ?></td>
		</tr>
	<?php $counter++; ?>
	<?php endforeach; ?>
		</tbody>
	</table>
	<hr>
	<?= $this->Form->submit() ?>
<?= $this->Form->end() ?>