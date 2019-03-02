<?php
// Skatepark Manager - UserManagement sidenav element
?>
<h3><?= __('Users Management') ?></h3>
<div class="list-group bg-dark">
	<!-- Users Index Link -->
	<?= $this->Html->link(__('Users'), 
			['controller' => 'Users', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<!-- Roles Index Link -->
	<?= $this->Html->link(__('Roles'), 
			['controller' => 'roles', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
</div>