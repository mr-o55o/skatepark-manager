<?php
// Skatepark Manager - Athletes Management sidenav element
?>
<div class="list-group bg-dark">
	<!-- Athletes Index Link -->
	<?= $this->Html->link(__('Athletes'), 
			['controller' => 'Athletes', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white ']
		); 

	?>
	<!-- ResponsiblePersons Index Link -->
	<?= $this->Html->link(__('Responsible Persons'), 
			['controller' => 'ResponsiblePersons', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

</div>