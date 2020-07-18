<?php
Use Cake\Core\Configure;
?>

<div class="content">
<h3><?= __('Corso') ?> <?= h($course_session->course->name) ?> <?= __('Livello') ?> <?= h($course_session->course->course_level->name) ?> - <?= __('Registro della sessione ') ?> <?= $course_session->id ?> <?= __('prevista il') ?> <?= $course_session->event->start_date->i18NFormat('dd/MM/yyyy @ HH:mm') ?></h3>
<?php if (count($partecipants) > 0) : ?>
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
				<td><?= $this->Html->link($partecipant->athlete->name.' '.$partecipant->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $partecipant->athlete_id]) ?></td>
				<td><?= ($partecipant->is_present ? __('Sì') : __('No')) ?></td>
				<td><?= ($partecipant->rent_skateboard ? __('Sì') : __('No')) ?></td>
				<td><?= ($partecipant->rent_helmet ? __('Sì') : __('No')) ?></td>
				<td><?= ($partecipant->rent_pads ? __('Sì') : __('No')) ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
<?php endif ?>
<?= $this->Html->link(__('Visualizza Corso ').h($course_session->course->name), ['controller' => 'Courses', 'action' => 'view', $course_session->course_id], ['class' => 'nav-link']) ?>
<?= $this->Html->link(__('Visualizza Sessione ').$course_session->id, ['controller' => 'CourseSessions', 'action' => 'view', $course_session->id], ['class' => 'nav-link']) ?>
</div>