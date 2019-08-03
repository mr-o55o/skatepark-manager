<?php
// Skatepark Manager - Events sidenav element
?>
<h3><?= __('Events') ?></h3>
<div class="list-group bg-dark">
	<!-- Events Calendar Link -->
	<?= $this->Html->link(__('Events'), 
			['controller' => 'Events', 'action' => 'calendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>	
</div>