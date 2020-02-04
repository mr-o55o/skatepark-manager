<?php
// Welcome Page to display has logged user home page
?>

<div class="content">
<?php if($loggedUser['role'] == 'Admin') : ?>
		<h1><?= __('Admin') ?></h1>
		<hr>
		<div class="row mb-2">
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Configurazione') ?></h5>
						TO-DO
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Utenti') ?></h5>
						<ul class="list-unstyled">
							<li><?= $this->Html->link(__('Ruoli'), ['controller' => 'Roles', 'action' => 'index']) ?></li>
							<li><?= $this->Html->link(__('Staff'), ['controller' => 'Users', 'action' => 'indexStaff']) ?></li>
						</ul>
					</div>
				</div>					
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Atleti') ?></h5>
						<ul class="list-unstyled">
							<li><?= $this->Html->link(__('Atleti'), ['controller' => 'Athletes', 'action' => 'index']) ?></li>
							<li><?= $this->Html->link(__('Persone responsabili'), ['controller' => 'ResponsiblePersons', 'action' => 'index']) ?></li>
						</ul>
					</div>
				</div>			
			</div>
		</div>		
		<div class="row">
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Attività') ?></h5>
						<ul class="list-unstyled">
							<li><?= $this->Html->link(__('Attività'), ['controller' => 'Activities', 'action' => 'index']) ?></li>
							<li><?= $this->Html->link(__('Tipi di attività'), ['controller' => 'ActivityTypes', 'action' => 'index']) ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Lezioni individuali') ?></h5>
						<ul class="list-unstyled">
							<li><?= $this->Html->link(__('Lezioni individuali'), ['controller' => 'LessonEditions', 'action' => 'index']) ?></li>
							<li><?= $this->Html->link(__('Tipi di lezione individuale'), ['controller' => 'Lessons', 'action' => 'index']) ?></li>
						</ul>						
					</div>
				</div>					
			</div>
			<div class="col-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title"><?= __('Corsi') ?></h5>
						TO-DO
					</div>
				</div>			
			</div>
		</div>
<?php endif; ?>
</div>

