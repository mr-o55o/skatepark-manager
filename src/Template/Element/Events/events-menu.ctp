<?php

?>

<ul class="nav justify-content-center">
  	<li class="nav-item">
    	<?= $this->Html->Link( __('Add activity'), ['controller' => 'Activities', 'action' => 'add'], ['class' => 'nav-link']); ?>
  	</li>
  	<li class="nav-item">
    	<?= $this->Html->Link( __('Add lesson edition'), ['controller' => 'LessonEditions', 'action' => 'add'], ['class' => 'nav-link']); ?>
  	</li>
</ul>