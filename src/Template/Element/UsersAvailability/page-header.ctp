<?php

?>
    <!-- action-bar -->
	<nav class="nav justify-content-end">
		<?= $this->Html->link(__('Aggiungi disponibilità'), 
		[
			'controller' => 'UsersAvailability', 
			'action' => 'add'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexUpcoming' ? 'active' : '')
		]) ?>
	</nav>