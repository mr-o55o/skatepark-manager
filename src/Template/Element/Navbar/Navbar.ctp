<?php
// Skatepark Manager - Navbar element
use Cake\Core\Configure;


/*
Topic based navigation bar
Acceppts active topic as variable, to set active status
*/
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
	  		<li class="nav-item rounded <?= ($active == 'Home' ? 'active' : '') ?>">
	  			<?= $this->Html->link(Configure::read('topics')['Home']['name'], '/pages/welcome', ['class' => 'nav-link text-white '])?>
	  		</li>
	  		<li class="nav-item rounded <?= ($active == 'Monitoring' ? 'active' : '') ?>">
	  			<?= $this->Html->link(Configure::read('topics')['Monitoring']['name'], ['controller' => 'Monitoring', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
	  		</li>	  		
		 	<li class="nav-item rounded <?= ($active == 'Events' ? 'active' : '') ?>">
		 		<?= $this->Html->link(Configure::read('topics')['Events']['name'], ['controller' => 'Events', 'action' => 'calendar'], ['class' => 'nav-link text-white'])?>
		 	</li>
		  	<li class="nav-item rounded <?= ($active == 'StaffManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(Configure::read('topics')['StaffManagement']['name'], ['controller' => 'Users', 'action' => 'indexStaff'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item rounded <?= ($active == 'AthletesManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(Configure::read('topics')['AthletesManagement']['name'], ['controller' => 'Athletes', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item rounded <?= ($active == 'LessonsManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(Configure::read('topics')['LessonsManagement']['name'], ['controller' => 'LessonEditions', 'action' => 'indexBooked'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item rounded <?= ($active == 'CoursesManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(Configure::read('topics')['CoursesManagement']['name'], ['controller' => 'Courses', 'action' => 'index'], ['class' => 'nav-link text-white'])?>
		  	</li>
		  	<li class="nav-item rounded <?= ($active == 'ActivitiesManagement' ? 'active' : '') ?>">
		  		<?= $this->Html->link(Configure::read('topics')['ActivitiesManagement']['name'], ['controller' => 'Activities', 'action' => 'indexScheduled'], ['class' => 'nav-link text-white'])?>
		  	</li>
	  	</ul>
	  	<!-- Logged user panel -->
	  	<ul class="navbar-nav">
	  		<li class="nav-item dropdown text-white">
	  			<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?= $loggedUser['username'] ?></a>
	  			<div class="dropdown-menu">
	  			<?= $this->Html->link(__('Profilo utente'), ['controller' => 'Users', 'action' => 'editProfile'], ['class' => 'dropdown-item']) ?>
	  			<?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item']) ?>
	  			</div>
	  		</li>
	  	</ul>
  	</div>
</nav>