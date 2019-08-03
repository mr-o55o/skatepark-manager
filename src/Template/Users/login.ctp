<?php

?>
<div class="content">
<h1>Skatepark Manager User Login</h1>
	<div class="row">
		<div class="col-sm-12 col-md-6">
			<?= __('Insert username and password to login to the system.') ?>
		</div>
		<div class="col-sm-12 col-md-6">
			<?= $this->Form->create() ?>
			<?= $this->Form->control('username', ['label' => false, 'autofocus' => 'autofocus', 'placeholder' => __('Username')]) ?>
			<?= $this->Form->control('password', ['label' => false, 'placeholder' => __('Password')]) ?>
			<?= $this->Form->button('Login') ?>
			<?= $this->Form->end() ?>
		</div>
	</div>
</div>