<?php
Use Cake\Core\Configure;
$counter = 0;
?>

<div class="content">
<h3><?= __('Corso') ?> <?= h($course_session->course->name) ?> <?= __('Livello') ?> <?= h($course_session->course->course_level->name) ?> - <?= __('Registro della sessione ') ?> <?= $course_session->id ?> <?= __('prevista il') ?> <?= $course_session->event->start_date->i18NFormat('dd/MM/yyyy @ HH:mm') ?></h3>
<?php if (count($partecipants) > 0) : ?>
	<?= $this->Form->create($partecipants) ?>
	<table class="table table-striped able-condensed">
		<thead>
			<tr>
				<th scope="col"><?= __('Atleta') ?></th>
				<th scope="col"><?= __('Presente') ?></th>
				<th scope="col"><?= __('Noleggio Skateboard') ?></th>
				<th scope="col"><?= __('Noleggio Casco') ?></th>
				<th scope="col"><?= __('Noleggio Pads') ?></th>
			</tr>
		</thead>
		<tbody>
		<?php foreach($partecipants as $partecipant) : ?>
			<tr>
				<td><?= h($partecipant->athlete->name . ' '. $partecipant->athlete->surname) ?></td>
				<td>
					<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][id]', ['type' => 'hidden', 'value' => $partecipant->id]); ?>
					<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][course_session_id]', ['type' => 'hidden', 'value' => $course_session->id]); ?>
					<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][athlete_id]', ['type' => 'hidden', 'value' => $partecipant->athlete_id]); ?>
					<?= $this->Form->control('CourseSessionPartecipants['.$counter.'][is_present]', ['type' => 'checkbox', 'value' => !$partecipant->is_present, 'label' => '']); ?>
				</td>
				<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_skateboard]', ['type' => 'checkbox', 'value' => !$partecipant->rent_skateboard, 'label' => '']); ?></td>
				<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_helmet]', ['type' => 'checkbox', 'value' => !$partecipant->rent_hekmet,'label' => '']); ?></td>
				<td><?= $this->Form->control('CourseSessionPartecipants['.$counter.'][rent_pads]', ['type' => 'checkbox', 'value' => !$partecipant->rent_pads, 'label' => '']); ?></td>
			</tr>
			<?php $counter++; ?>
		<?php endforeach; ?>
		</tbody>

	</table>
		<?= $this->Form->Submit(__('Salva')) ?>
	<?= $this->Form->end() ?>
<?php endif ?>
<?= $this->Html->link(__('Visualizza Corso ').h($course_session->course->name), ['controller' => 'Courses', 'action' => 'view', $course_session->course_id], ['class' => 'nav-link']) ?>
<?= $this->Html->link(__('Visualizza Sessione ').$course_session->id, ['controller' => 'CourseSessions', 'action' => 'view', $course_session->id], ['class' => 'nav-link']) ?>
</div>