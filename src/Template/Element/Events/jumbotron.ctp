<?php

?>
<div class="jumbotron jumbotron-fluid p-3">
    <h3>
    	<?= __('Events') ?>
    	<small><?= __('Events planning') ?></small>	
    </h3>
	<div class="d-flex flex-row mb-3 bg-dark rounded text-white">
		<div class="p-2"><?= $this->Html->Link( __('Calendar'), ['controller' => 'LessonEditions', 'action' => 'calendar'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'calendar' ? 'active' : '')]]); ?></div>
    	<div class="p-2"><?= $this->Html->Link( __('Add New Lesson Edition'), ['controller' => 'LessonEditions', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' && $this->request->controller == 'LessonEditions' ? 'active' : '')]]); ?></div>
    	<div class="p-2"><?= $this->Html->Link( __('Add New Activity'), ['controller' => 'Activities', 'action' => 'add'], ['class' => ['btn', 'btn-primary ' . ($this->request->action == 'add' && $this->request->controller == 'Activities' ? 'active' : '')]]); ?></div>
    </div>
</div>