<?php


?>
<div class="content">
	<div class="jumbotron text-center">
		<img class="img-fluid" src="/img/skatepark-manager.png" alt="Skatepark Manager Logo">
		<h1 class="text-center">Welcome to Skatepark Manager</h1>
		<h3>Version 0.1 features</h3>
		<ul>
			<li>Role based access to management functions (Admin, manager, staff)</li>
			<li>Members Management</li>
			<li>Athletes Management</li>
			<li>Lessons Management (Lesson definition, scheduling and booking)</li>
		</ul>
	    <?php if ($loggedUser == null ) : ?>
	         <?= $this->Html->Link('Click here to perform Login', ['controller' => 'Users', 'action' => 'login'], ['class' => ['btn', 'btn-primary']]) ?>
	    <?php else : ?>
	    	<?= __('Dear') ?> <?= $loggedUser['name'] ?>, <?= __('You are logged in as') ?> <?= $loggedUser['role'] ?>.
	   	<?php endif; ?>
    </div>
</div>
