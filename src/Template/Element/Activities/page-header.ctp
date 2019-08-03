<?php

?>
    <!-- action-bar -->
	<div class="btn-group mb-3" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('Attività in programma'), 
		[
			'controller' => 'Activities', 
			'action' => 'indexUpcoming'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'indexUpcoming' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Tutte le attività'), 
		[
			'controller' => 'Activities', 
			'action' => 'index'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Programma nuova attività'), 
		[
			'controller' => 'Activities', 
			'action' => 'add'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'add' ? 'active' : '')
		]) ?>
	</div>



