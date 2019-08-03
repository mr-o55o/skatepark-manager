<?php
// Skatepark Manager - Administration sidenav element
?>
<h3><?= __('Events') ?></h3>
<div class="list-group bg-dark">
	<!-- Events Calendar Link -->
	<?= $this->Html->link(__('Index'), 
			['controller' => 'Administration', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<?= $this->Html->link(__('Manage Users'), 
			['controller' => 'Users', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<?= $this->Html->link(__('Manage Activity Types'), 
			['controller' => 'ActivityTypes', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<?= $this->Html->link(__('Manage Lessons'), 
			['controller' => 'Lessons', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<?= $this->Html->link(__('Manage Lesson Editions Bundles'), 
			['controller' => 'LessonEditionsBundles', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>	
</div>