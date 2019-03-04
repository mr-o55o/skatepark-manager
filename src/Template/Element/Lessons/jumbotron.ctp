<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3>
    	<?= __('Lessons') ?>
    	<small class="text-muted"><?= __('Manage Lessons.') ?></small>	
    </h3>
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Defined Lessons'), ['controller' => 'Lessons', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('Add New Lesson'), ['controller' => 'Lessons', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' ? 'active' : '')]]); ?></div>
    </div>
</div>