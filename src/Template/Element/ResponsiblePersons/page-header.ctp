<?php

?>
    <!-- action-bar -->
	<div class="btn-group mb-3" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('Atleti'), 
		[
			'controller' => 'Athletes', 
			'action' => 'index'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'index' ? 'active' : '')
		]) ?>

		<?= $this->Html->link(__('Aggiungi nuovo atleta'), 
		[
			'controller' => 'Athletes', 
			'action' => 'add'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'add' ? 'active' : '')
		]) ?>
	</div>



