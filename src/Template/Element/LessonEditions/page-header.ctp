<?php

?>
    <!-- action-bar -->
	<div class="btn-group mb-3" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('Booked Lessons Editions'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexBooked'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'indexBooked' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('All Lessons Editions'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'index'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Add new Lesson Edition'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'add'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'add' ? 'active' : '')
		]) ?>
	</div>



