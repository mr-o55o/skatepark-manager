<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3><?= __('Activities') ?></h3>
    <small><?= __('') ?></small>
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Upcoming Activities'), ['controller' => 'Activities', 'action' => 'indexUpcoming'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'indexUpcoming' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('All Activities'), ['controller' => 'Activities', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('Add New Activity'), ['controller' => 'Activities', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' ? 'active' : '')]]); ?></div>
    </div>
</div>