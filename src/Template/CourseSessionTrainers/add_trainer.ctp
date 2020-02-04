<?php

?>

<?= $this->Form->create($course_session_trainer); ?>
	<?= $this->Form->control('user_id', ['options' => $available_trainers, 'label' => false])?>
	<?= $this->Form->submit(); ?>
<?= $this->Form->end(); ?>