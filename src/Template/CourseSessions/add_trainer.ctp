<?php

?>

<?= $this->Form->create($course_session); ?>
	<?= $this->Form->control('course_session.course_session_trainers.0.user_id', ['options' => $available_trainers, 'label' => false])?>
	<?= $this->Form->submit(); ?>
<?= $this->Form->end(); ?>