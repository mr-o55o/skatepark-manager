<?php

?>

<?= $this->Form->create('LessonEdition'); ?>
	<h2>Step 1: Select Lesson Type</h2>
	<?= $this->Form->control('lesson_id', ['options', $lessons ]) ?>
	<div class="submit">
		<?= $this->Form->submit('Continue', array('div' => false)); ?>
		<?= $this->Form->submit('Cancel', array('name' => 'Cancel', 'div' => false)); ?>
	</div>
<?= $this->Form->end() ?>

