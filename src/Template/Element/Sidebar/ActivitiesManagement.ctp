<?php
// Skatepark Manager - LessonsManagement sidenav element
?>
<h4><?= __('Gestione Attività') ?></h4>
<div class="list-group bg-dark">
	<!-- Booked Lesson Editions Index Link -->
	<?= $this->Html->link(__('Attività'), 
			['controller' => 'Activities', 'action' => 'indexScheduled'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'Activities' && in_array($this->request->action,['index', 'indexUpcoming', 'indexExpired', 'view', 'edit']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Definisci nuova Attività'), 
			['controller' => 'Activities', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'Activities' && in_array($this->request->action,['add']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Wizard Attività'), 
			['controller' => 'Activities', 'action' => 'wizard'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'Activities' && in_array($this->request->action,['wizard']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Tipi di Attività'), 
			['controller' => 'ActivityTypes', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white ']
		); 

	?>	
</div>

