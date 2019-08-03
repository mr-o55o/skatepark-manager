<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3><?= __('Activity Types') ?></h3>
    <small><?= __('') ?></small>
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Activity Types'), ['controller' => 'ActivityTypes', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('Add New Type'), ['controller' => 'ActivityTypes', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' ? 'active' : '')]]); ?></div>
    </div>
</div>