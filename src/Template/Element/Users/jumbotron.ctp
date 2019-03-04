<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3>
    	<?= __('Users') ?>
    	<small class="text-muted"><?= __('Create users and edit their details') ?></small>
    </h3>
    
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Users List'), ['controller' => 'Users', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?> </div>
		<div class="p-2"><?= $this->Html->Link( __('Add New User'), ['controller' => 'Users', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' ? 'active' : '') ]]); ?> </div>
    </div>
</div>