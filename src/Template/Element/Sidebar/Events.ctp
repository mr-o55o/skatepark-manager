<?php
// Skatepark Manager - Events sidenav element
use Cake\I18n\Time;
$now = Time::now();
?>
<h3><?= __('Events') ?></h3>
<div class="list-group bg-dark">
	<!-- Events Calendar Link -->
	<?= $this->Html->link(__('Eventi'), 
			['controller' => 'Events', 'action' => 'calendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->action == 'calendar' ? 'active' : '')]
		); 

	?>	

	<!-- Today Link -->
	<?= $this->Html->link(__('Eventi di oggi'), 
			['controller' => 'Events', 'action' => 'day', $now->year . '-' . $now->month . '-' . $now->day], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->action == 'day' ? 'active' : '')]
		); 

	?>	

	<?= $this->Html->link(__('Calendario delle Attività'), 
			['controller' => 'Events', 'action' => 'activitiesCalendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->action == 'activitiesCalendar' ? 'active' : '')]
		); 

	?>	

	<?= $this->Html->link(__('Calendario delle Lezioni Individuali'), 
			['controller' => 'Events', 'action' => 'lessonEditionsCalendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->action == 'lessonEditionsCalendar' ? 'active' : '')]
		); 

	?>	

	<?= $this->Html->link(__('Calendario dei Corsi'), 
			['controller' => 'Events', 'action' => 'courseSessionsCalendar'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->action == 'courseSessionsCalendar' ? 'active' : '')]
		); 

	?>
</div>