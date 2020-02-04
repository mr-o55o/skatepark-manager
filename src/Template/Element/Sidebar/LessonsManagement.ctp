<?php
// Skatepark Manager - LessonsManagement sidenav element
?>
<h3><?= __('Gestione Lezioni') ?></h3>
<div class="list-group bg-dark">
	<!-- Lesson Editions Index Link -->
	<?= $this->Html->link(__('Lezioni Individuali'), 
			['controller' => 'LessonEditions', 'action' => 'indexBooked'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'LessonEditions' && in_array($this->request->action, ['index', 'indexBooked', 'changeTrainer', 'bookForAthlete', 'manageEquipRental', 'view']) ? 'active' : '')]
		); 

	?>

	<!-- Lesson Editions addBooked Link -->
	<?= $this->Html->link(__('Prenota una lezione individuale'), 
			['controller' => 'LessonEditions', 'action' => 'addBooked'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'LessonEditions'  &&  $this->request->action == 'addBooked' ? 'active' : '')]
		); 

	?>

	<!-- Lesson Editions Wizard Link -->
	<?= $this->Html->link(__('Wizard Lezioni individuali'), 
			['controller' => 'LessonEditions', 'action' => 'wizard'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'LessonEditions'  &&  $this->request->action == 'wizard' ? 'active' : '')]
		); 

	?>

	<!-- Lessons Index Link -->
	<?= $this->Html->link(__('Tipi di Lezione Individuali'), 
			['controller' => 'Lessons', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'Lessons' && $this->request->action == 'index' ? 'active' : '')]
		); 

	?>

	<!-- Purchased Active Lesson Editions Bundles Index Link -->
	<?= $this->Html->link(__('Pacchetti di Lezioni'), 
			['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'indexActive'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'PurchasedLessonEditionsBundles' && in_array($this->request->action, ['index', 'indexActive', 'indexToExpire']) ? 'active' : '')]
		); 

	?>
</div>