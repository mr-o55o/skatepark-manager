<?php
// Skatepark Manager - Events sidenav element
?>
<div class="list-group bg-dark">
	<!-- Events Calendar Link -->
	<?= $this->Html->link(__('Events'), 
			['controller' => 'Events', 'action' => 'calendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Add activity Link -->
	<?= $this->Html->link(__('Add Activity'), 
			['controller' => 'Activities', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Add activity Link -->
	<?= $this->Html->link(__('Add Lesson Edition'), 
			['controller' => 'LessonEditions', 'action' => 'add'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>		
</div>