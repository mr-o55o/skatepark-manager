<?php
// Skatepark Manager - Athletes Management sidenav element
?>
<h3><?= __('Gestione Atleti') ?></h3>
<div class="list-group bg-dark">
	<!-- Athletes Index Link -->
	<?= $this->Html->link(__('Atleti'), 
			['controller' => 'Athletes', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'Athletes' && in_array($this->request->action,['index', 'indexActive', 'indexExpired', 'view', 'edit']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Registra un nuovo atleta'), 
			['controller' => 'Athletes', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'Athletes' && $this->request->action == 'add' ? 'active' : '')]
		); 

	?>
	<!-- ResponsiblePersons Index Link -->
	<?= $this->Html->link(__('Persone responsabili (per gli atleti minori)'), 
			['controller' => 'ResponsiblePersons', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'ResponsiblePersons' && in_array($this->request->action, ['index', 'view', 'edit']) ? 'active' : '')]
		); 

	?>

	<?= $this->Html->link(__('Registra nuovo responsabile'), 
			['controller' => 'ResponsiblePersons', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'ResponsiblePersons' && $this->request->action == 'add' ? 'active' : '')]
		); 

	?>

</div>