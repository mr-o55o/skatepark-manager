<?php
// Skatepark Manager - Navbar element

use Cake\Core\Configure;

?>
<nav class="navbar sticky-top navbar-expand-lg navbar-inverse bg-dark">
	<a class="navbar-brand" href="/">Skatepark Manager</a>
  	<!-- Navbar Toggler-->
  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="true" aria-label="Toggle navigation">
  	<span class="navbar-toggler-icon"></span>
  	</button>
  	<!-- Navbar Links -->
  	<div class="collapse navbar-collapse text-right" id="'navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
	  		<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'Home' ? 'active' : '') ?>">
	  			<?= $this->Html->link(__('Home'), '/pages/welcome', ['class' => 'nav-link text-white '])?>
	  		</li>
		 	<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'Events' ? 'active' : '') ?>">
		 		<?= $this->Html->link(__('Events'), ['controller' => 'Events', 'action' => 'calendar'], ['class' => 'nav-link text-white'])?>
		 	</li>
		  	<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'AthletesManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(__('Athletes Management'), ['controller' => 'Athletes', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'LessonsManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(__('Lessons Management'), ['controller' => 'LessonEditions', 'action' => 'indexBooked'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'ActivitiesManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(__('Activities Management'), ['controller' => 'Activities', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item <?= (Configure::read('main_nav')['controllers'][$this->request->controller]['topic'] == 'Administration' ? 'active' : '') ?>">
		  		<?= $this->Html->link(__('Administration'), ['controller' => 'Administration', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
		  	</li>
	  	</ul>
	  	<!-- Logged user panel -->
	  	<ul class="navbar-nav">
	  		<li class="nav-item dropdown text-white">
	  			<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?= $loggedUser['username'] ?></a>
	  			<div class="dropdown-menu">
	  			<?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
	  			</div>
	  		</li>
	  	</ul>
  	</div>
</nav>