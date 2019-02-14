<?php
// Skatepark Manager - LessonsManagement sidenav element
?>
<div class="list-group bg-dark">
	<!-- Lessons Index Link -->
	<?= $this->Html->link(__('Lessons'), 
			['controller' => 'Lessons', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<!-- Booked Lesson Editions Index Link -->
	<?= $this->Html->link(__('Booked Lessons Editions'), 
			['controller' => 'LessonEditions', 'action' => 'indexBooked'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
	<!-- Lesson Editions Bundles Index Link -->
	<?= $this->Html->link(__('Lesson Editions Bundles'), 
			['controller' => 'LessonEditionsBundles', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>

	<!-- Purchased Lesson Editions Bundles Index Link -->
	<?= $this->Html->link(__('Purchased Lesson Editions Bundles'), 
			['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'index'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white']
		); 

	?>
</div>