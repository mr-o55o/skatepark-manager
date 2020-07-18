<?php

?>
    <!-- action-bar -->
	<nav class="nav bg-gray text-white rounded mb-4 justify-content-center">
		<?= $this->Html->link(__('Tutti i Corsi'), 
		[
			'controller' => 'Courses', 
			'action' => 'index'
		], [
			'class' => 'nav-link '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Corsi in bozza'), 
		[
			'controller' => 'Courses', 
			'action' => 'indexDraft'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexDraft' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Corsi pianificati'), 
		[
			'controller' => 'Courses', 
			'action' => 'indexScheduled'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexScheduled' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Corsi attivi'), 
		[
			'controller' => 'Courses', 
			'action' => 'indexActive'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexActive' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Corsi completati'), 
		[
			'controller' => 'Courses', 
			'action' => 'indexCompleted'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexCompleted' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Corsi Annullati'), 
		[
			'controller' => 'Courses', 
			'action' => 'indexCancelled'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexCancelled' ? 'active' : '')
		]) ?>
	</nav>



