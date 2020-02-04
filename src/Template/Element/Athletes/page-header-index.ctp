<?php

?>
    <!-- action-bar -->
	<nav class="nav rounded mb-4 justify-content-center">
		
		<?= $this->Html->link(__('Elenco atleti'), 
		[
			'controller' => 'Athletes', 
			'action' => 'index'
		], [
			'class' => 'nav-link '.($this->request->action == 'index' ? 'active' : '')
		]) ?>

		<?= $this->Html->link(__('Elenco atleti attivi'), 
		[
			'controller' => 'Athletes', 
			'action' => 'indexActive'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexActive' ? 'active' : '')
		]) ?>

		<?= $this->Html->link(__('Elenco atleti con iscrizione scaduta'), 
		[
			'controller' => 'Athletes', 
			'action' => 'indexExpired'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexExpired' ? 'active' : '')
		]) ?>
		
	</nav>
	<hr>


