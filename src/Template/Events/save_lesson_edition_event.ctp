<?php 

?>
<h1><?= __('Save Lesso Edition Event') ?></h1>
<?= $this->Form->create($event) ?>
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
	<tr>
		<th scope="row"><?= __('Trainer')?></th> 
		<td><?= ($event->lesson_edition->user ? $event->lesson_edition->user->username : '-') ?></td>
	</tr>
	<tr>
		<th scope="row"><?= __('Athlete')?></th> 
		<td><?= ($event->lesson_edition->athlete ? $event->lesson_edition->athlete->name . ' ' . $event->lesson_edition->athlete->surname : '-') ?></td>
	</tr>
</table>
<?= $this->Form->textArea('lesson_edition_notes') ?>


<ul class="nav justify-content-center">
	<li><?= $this->Form->button('Save this Event', ['class' => 'btn btn-primary']) ?></li>
	<li><?= $this->Html->link(__('Back to Athlete selection'), ['controller' => 'Athletes', 'action' => 'selectAthlete'], ['class' => 'btn btn-primary'] ) ?></li>
</ul>
<?= $this->Form->end() ?>