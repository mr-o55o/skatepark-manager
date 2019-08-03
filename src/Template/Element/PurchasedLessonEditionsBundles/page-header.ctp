<?php

?>
    <!-- action-bar -->
	<div class="btn-group mb-3" role="group" aria-label="Basic example">
		<?= $this->Html->link(__('Active  Lessons Editions Bundles'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'indexActive'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'indexActive' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('Lessons Editions Bundles to be marked as expired'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'indexToExpire'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'indexToExpire' ? 'active' : '')
		]) ?>
		<?= $this->Html->link(__('All Lessons Editions Bundles'), 
		[
			'controller' => 'PurchasedLessonEditionsBundles', 
			'action' => 'index'
		], [
			'class' => 'btn btn-primary '.($this->request->action == 'index' ? 'active' : '')
		]) ?>
	</div>



