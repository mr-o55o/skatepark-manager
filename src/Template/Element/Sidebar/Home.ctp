<?php
// Skatepark Manager - Pages sidenav element
?>
<h3><?= __('Home') ?></h3>
<div class="list-group bg-dark">
	<!-- Welcome Link -->
	<?= $this->Html->link(__('Welcome'), 
			['controller' => 'Pages', 'action' => 'display', 'welcome'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Documentation Link -->
	<?= $this->Html->link(__('Skateboard Manager Wiki'), 'https://github.com/mr-o55o/skatepark-manager/wiki', 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 
	?>

</div>