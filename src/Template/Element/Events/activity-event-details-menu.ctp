<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">
	<li class="nav-item"><?= $this->Html->link('Edit Activity Event', ['controller' => 'Events', 'action' => 'editActivityEvent', $event->id], ['class' => 'nav-link'])?></li>
</ul>


