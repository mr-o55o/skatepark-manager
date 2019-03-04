<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3><?= __('Purchased Lesson Editions Bundles') ?> <small><?= __('Manage purchased bundles') ?></small></h3>
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
    	<div class="p-2"><?= $this->Html->Link( __('Active Lesson Editions Bundles'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'indexActive'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'indexActive' ? 'active' : '') ]]); ?></div>
    	<div class="p-2"><?= $this->Html->Link( __('All Purchased Lesson Editions Bundles'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?></div>
		
    </div>
</div>