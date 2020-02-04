<?php

?>
    <!-- action-bar -->
	<nav class="nav rounded mb-4 justify-content-center">
		<?= $this->Html->link(__('Pacchetti attivi'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'indexActive'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexActive' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Pacchetti in scadenza'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'indexToExpire'
		], [
			'class' => 'nav-link '.($this->request->action == 'indexToExpire' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Tutti i pacchetti di lezioni'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'index'
		], [
			'class' => 'nav-link '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
	</nav>



