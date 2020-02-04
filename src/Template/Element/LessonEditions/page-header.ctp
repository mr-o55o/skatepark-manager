<?php

?>
    <!-- action-bar -->
	<nav class="nav bg-gray text-white rounded mb-4 justify-content-center">
		<?= $this->Html->link(__('Lezioni in bozza'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexDraft'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexDraft' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Lezioni con istruttore assegnato'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexTrainerAssigned'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexTrainerAssigned' ? 'active' : '')
		]) ?>	
		<?= $this->Html->link(__('Lezioni prenotate'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexBooked'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexBooked' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Lezioni completate'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexCompleted'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexCompleted' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Lezioni annullate'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'indexCancelled'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexCancelled' ? 'active' : '')
		]) ?>

		<?= $this->Html->link(__('Tutte le lezioni'), 
		[
			'controller' => 'LessonEditions', 
			'action' => 'index'
		], [
			'class' => 'nav-link '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
	</nav>



