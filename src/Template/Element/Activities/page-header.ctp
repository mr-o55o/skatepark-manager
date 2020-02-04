<?php

?>
    <!-- action-bar -->
	<nav class="nav justify-content-center">
		<?= $this->Html->link(__('Attività in programma'), 
		[
			'controller' => 'Activities', 
			'action' => 'indexScheduled'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexScheduled' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Attività completate'), 
		[
			'controller' => 'Activities', 
			'action' => 'indexCompleted'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexCompleted' ? 'active' : '')
		]) ?>		
		<?= $this->Html->link(__('Tutte le attività'), 
		[
			'controller' => 'Activities', 
			'action' => 'index'
		], [
			'class' => 'nav-link '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
	</nav>



