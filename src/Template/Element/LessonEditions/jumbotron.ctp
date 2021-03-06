<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3>
    	<?= __('Lesson Editions') ?>
    	<small class="text-muted"><?= __('Manage Lesson Editions') ?></small>
    </h3>
    <div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Currently Booked Lesson Editions'), ['controller' => 'LessonEditions', 'action' => 'indexBooked'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'indexBooked' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('All Lesson Editions'), ['controller' => 'LessonEditions', 'action' => 'index'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'index' ? 'active' : '') ]]); ?></div>
		<div class="p-2"><?= $this->Html->Link( __('Add New Lesson Edition'), ['controller' => 'LessonEditions', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' ? 'active' : '')]]); ?></div>
    </div>
</div>