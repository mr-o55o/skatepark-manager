<?php


?>
<div class="content">
	<div class="jumbotron text-center">
		<img class="img-fluid" src="/img/skatepark-manager.png" alt="Skatepark Manager Logo">
	    <?php if ($loggedUser == null ) : ?>
	         <?= $this->Html->Link('Click here to perform Login', ['controller' => 'Users', 'action' => 'login'], ['class' => ['btn', 'btn-primary']]) ?>
	    <?php else : ?>
	    	<?= __('Dear') ?> <?= $loggedUser['name'] ?>, <?= __('You are logged in as') ?> <?= $loggedUser['role'] ?>.
	   	<?php endif; ?>
    </div>
</div>
