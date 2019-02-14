<?php
// Skatepark Manager - Pages sidenav element
?>
<div class="list-group bg-dark">
	<!-- Home Link -->
	<?= $this->Html->link(__('Home'), 
			['controller' => 'Pages', 'action' => 'display'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Welcome Link -->
	<?= $this->Html->link(__('Welcome'), 
			['controller' => 'Pages', 'action' => 'display', 'welcome'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Documentation Link -->
	<?= $this->Html->link(__('Documentation'), 
			['controller' => 'Pages', 'action' => 'display', 'docs'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 
	?>
</div>