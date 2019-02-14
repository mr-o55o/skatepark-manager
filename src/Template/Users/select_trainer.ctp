
<?php

?>
<h1><?= __('Trainer Selection') ?></h1>

<?= $this->Form->create($user); ?>
<fieldset>
<table class="table table-striped">
	<tr>
		<th scope="row"><?= __('Lesson Type')?></th> 
		<td><?= $event->lesson_edition->lesson->name ?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('Lesson Duration')?></th> 
		<td><?= $event->lesson_edition->lesson->duration ?> <?= __('minutes')?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('Lesson Price')?></th> 
		<td><?= $this->Number->currency($event->lesson_edition->lesson->price) ?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('Event starts at')?></th> 
		<td><?= $event->start_date->nice() ?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('Event ends at')?></th> 
		<td><?= $event->end_date->nice() ?></td>
	</tr>	
</table>

<h2><?= __('Available Trainers') ?></h2>
<?= $this->Form->control('user_id', ['empty' => true, 'options' => $trainers, 'label' => __('Select a trainer')]); ?>
<ul class="nav justify-content-center">
	<li><?= $this->Form->button('Proceed to athlete selection'); ?></li>
	<li><?= $this->Html->link(__('Back to event definition'), ['controller' => 'Events', 'action' => 'addLessonEditionEvent'], ['class' => 'btn btn-primary'] ) ?></li>
</ul>
</fieldset>
<?= $this->Form->end(); ?>

