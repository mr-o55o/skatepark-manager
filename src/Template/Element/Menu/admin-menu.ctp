<?php

?>
<h5><?= __('Users Management') ?></h5>
<ul>
	<li><?=$this->Html->Link(__('Users'), ['controller' => 'Users', 'action' => 'index'], ['class' => '' ]) ?></li>
	<li><?=$this->Html->Link(__('Roles'), ['controller' => 'Roles', 'action' => 'index'], ['class' => '' ]) ?></li>
</ul>

<h5><?= __('Athletes Management') ?></h5>
<ul>
	<li ><?=$this->Html->Link(__('Athletes'), ['controller' => 'Athletes', 'action' => 'index']) ?></li>
	<li ><?=$this->Html->Link(__('Responsible Persons'), ['controller' => 'ResponsiblePersons', 'action' => 'index']) ?></li>
</ul>

<h5><?= __('Events') ?></h5>
<ul>
	<li><?=$this->Html->Link(__('Calendar'), ['controller' => 'Events', 'action' => 'calendar']) ?></li>
</ul>

<h5><?= __('Lessons Management') ?></h5>
<ul>
	<li><?=$this->Html->Link(__('Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?></li>
	<li><?=$this->Html->Link(__('New Lesson Edition Event'), ['controller' => 'LessonEditions', 'action' => 'add']) ?></li>
	<li><?=$this->Html->Link(__('Lesson Editions Bundles'), ['controller' => 'LessonEditionsBundles', 'action' => 'index']) ?></li>
	<li><?=$this->Html->Link(__('Purchased Lesson Editions Bundles'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'index']) ?></li>
</ul>

<h5><?= __('Activities Management') ?></h5>
<ul>
	<li><?= $this->Html->Link(__('Activity Types'), ['controller' => 'ActivityTypes', 'action' => 'index']) ?></li>
	<li><?=$this->Html->Link(__('New Activity Event'), ['controller' => 'Activities', 'action' => 'add']) ?></li>
</ul>
