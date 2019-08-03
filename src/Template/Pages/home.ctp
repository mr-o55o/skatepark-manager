<?php


?>
<div class="content">
	<div class="jumbotron bg-dark text-white text-center">
		<div>
		<img class="img-fluid" src="/img/skatepark-manager-2.png" width="50%" height="50%" alt="Skatepark Manager Logo">
		</div>
		<hr class="bg-white">
		<h4>SkateparkManager CakePHP Webapp - Version 1.0</h4>
	    <?php if ($loggedUser == null ) : ?>
	    	<div class="card mb-5">
	    		<div class="card-body rounded bg-dark text-white">
	    			<h5 class="'card-title text-left"><?= __('Login') ?></h5>
	    			<hr class="bg-white">
			    	<?= $this->Form->create('user', ['url' => ['controller' => 'Users', 'action' => 'login']]) ?>
			    	<div class="row">
			    		<div class="col">
			    			<?= $this->Form->input('username', ['label' => false, 'autofocus' => 'autofocus', 'class' => 'form-control form-control-lg', 'placeholder' => 'Username']) ?>
			    		</div>
			    		<div class="col">
			    			<?= $this->Form->input('password', ['label' => false, 'class' => 'form-control form-control-lg', 'placeholder' => 'Password']) ?>
			    		</div>
			    	</div>
					<?= $this->Form->button('Login') ?>
					<?= $this->Html->link(__('Forgot username or password?'), ['controller' => 'Users', 'action' => 'sendCredentials']) ?>
					<?= $this->Form->end() ?>	    			
	    		</div>
	    	</div>
	    <?php else : ?>
	    	<?= __('Dear') ?> <?= $loggedUser['name'] ?>, <?= __('You are logged in as') ?> <?= $loggedUser['role'] ?>.
	   	<?php endif; ?>
	   	<h5><?= __('Project') ?></h5>
	   	<hr class="bg-white">
	   	<div class="d-flex flex-row rounded">
	   		<div class="p-2"><?= $this->Html->link('<i class="fas fa-envelope-square fa-2x"></i> '.'Contact mr-o55o', 'mailto:marco.rinaldi.o55o@gmail.com', ['class' => 'btn btn-info', 'escape' => false])?></div>
	   		<div class="p-2"><?= $this->Html->link('<i class="fab fa-github fa-2x"></i> '.'Github Repository', 'https://github.com/mr-o55o/skatepark-manager',  ['class' => 'btn btn-info', 'escape' => false])?></div>
	   		<div class="p-2"><?= $this->Html->link('<i class="fas fa-book fa-2x"></i> '.'Project Documentation', 'https://github.com/mr-o55o/skatepark-manager/wiki',  ['class' => 'btn btn-info', 'escape' => false])?></div>
	   	</div>
    </div>
</div>
