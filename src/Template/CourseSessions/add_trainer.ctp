<?php

?>
<div class="content">
<h3><?= __('Corso') ?> <?= h($course_session->course->name)?> - <?= __('sessione del') ?> <?= $course_session->event->start_date->i18nFormat('dd/MM/YYYY HH:mm') ?></h3>

<?= $this->Form->create($course_session); ?>
	<label><?= __('Seleziona un istruttore tra quelli disponibili')?></label>
	<?= $this->Form->control('course_session.course_session_trainers.0.user_id', ['options' => $available_trainers, 'label' => false])?>
	<hr>
	<?= $this->Form->submit(__('Assegna istruttore')); ?>
<?= $this->Form->end(); ?>
</div>