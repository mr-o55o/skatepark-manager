<?php
// Skatepark Manager - UserManagement sidenav element
?>
<h3><?= __('Users Management') ?></h3>
<div class="list-group bg-dark">
	<!-- Users Index Link -->
	<?= $this->Html->link(__('Membri dello Staff'), 
			['controller' => 'Users', 'action' => 'indexStaff'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<?= $this->Html->link(__('Aggiungi nuovo membro dello staff'), 
			['controller' => 'Users', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<?= $this->Html->link(__('Gestione delle disponibilità'), 
			['controller' => 'UsersAvailability', 'action' => 'calendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<?= $this->Html->link(__('Membri dello Staff non più attivi'), 
			['controller' => 'Users', 'action' => 'indexStaffInactive'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>		
	<!-- Roles Index Link -->
	<?= $this->Html->link(__('Ruoli'), 
			['controller' => 'roles', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
</div>