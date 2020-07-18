<?php
// Skatepark Manager - UserManagement sidenav element
?>
<h3><?= __('Gestione Corsi') ?></h3>
<div class="list-group bg-dark">
	<?= $this->Html->link(__('Tipi di Abbonamento'), 
			['controller' => 'CourseSubscriptionTypes', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CourseSubscriptionsTypes' && in_array($this->request->action,['index']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Elenco Abbonamenti'), 
			['controller' => 'CourseSubscriptions', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CourseSubscriptions' && in_array($this->request->action,['index']) ? 'active' : '' )]
		); 

	?>
	<?= $this->Html->link(__('Elenco Abbonamenti Validi nel Periodo Corsi Attivo'), 
			['controller' => 'CourseSubscriptions', 'action' => 'indexValidForActiveCoursePeriod'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CourseSubscriptions' && in_array($this->request->action,['indexValidForActiveCoursePeriod']) ? 'active' : '' )]
		); 

	?>

	<?= $this->Html->link(__('Periodi dei Corsi'), 
			['controller' => 'CoursePeriods', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CoursePeriods' && in_array($this->request->action,['index']) ? 'active' : '' )]
		); 

	?>

	<?= $this->Html->link(__('Creazione Classi'), 
			['controller' => 'CourseClasses', 'action' => 'addClasses'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CourseClasses' && in_array($this->request->action,['createClasses']) ? 'active' : '' )]
		); 

	?>

	<?= $this->Html->link(__('Elenco Classi'), 
			['controller' => 'CourseClasses', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '.( $this->request->controller == 'CourseClasses' && in_array($this->request->action,['index']) ? 'active' : '' )]
		); 

	?>

</div>