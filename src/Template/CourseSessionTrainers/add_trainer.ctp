<?php

?>
<div class="content">
	<h3><?= __('Corso') ?> <?= h($course_session->course->name)?> - <?= __('sessione del') ?> <?= $course_session->event->start_date->i18nFormat('dd/MM/YYYY HH:mm') ?></h3>
	<?= $this->Html->link(__('Visualizza Corso ').$course_session->course->name, ['controller' => 'Courses', 'action' => 'view', $course_session->course->id], ['class' => 'btn btn-primary'])?>
	<hr>
	<?php if (!empty($available_trainers)) : ?>
		<?= $this->Form->create($course_session_trainer); ?>
			<label><?= __('Seleziona un istruttore tra quelli disponibili') ?></label>
			<?= $this->Form->control('user_id', ['options' => $available_trainers, 'label' => false])?>
			<hr>
			<?= $this->Form->submit(); ?>
		<?= $this->Form->end(); ?>
	<?php else : ?>
		<div class="alert alert-warning"><?= __('Non ci sono istruttori da assegnare, verificare che abbiano dato disponibilità e non siano impegnati in altre attività. ') ?></div>
	<?php endif; ?>
</div>