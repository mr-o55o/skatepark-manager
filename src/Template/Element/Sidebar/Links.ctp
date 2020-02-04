<?php

?>
<h3><?= __('Collegamenti') ?></h3>
<div class="list-group bg-dark">
	<?= $this->Html->link(__('Skatepark Manager Wiki'), 
			'https://github.com/mr-o55o/skatepark-manager/wiki', 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white ', 'target' => '_blank']
		); 

	?>

	<?= $this->Html->link(__('Skatepark Website'), 
			'http://bunkerskatepark.org', 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white ', 'target' => '_blank']
		); 

	?>

	<?= $this->Html->link(__('ASI'), 
			'http://www.asinazionale.it/', 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white ', 'target' => '_blank']
		); 

	?>


</div>