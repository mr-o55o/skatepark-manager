<?php
// Skatepark Manager - LessonsManagement sidenav element
?>
<h3><?= __('Lessons Management') ?></h3>
<div class="list-group bg-dark">
	<!-- Booked Lesson Editions Index Link -->
	<?= $this->Html->link(__('Lesson Editions'), 
			['controller' => 'LessonEditions', 'action' => 'indexBooked'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'LessonEditions' ? 'active' : '')]
		); 

	?>
	<!-- Purchased Active Lesson Editions Bundles Index Link -->
	<?= $this->Html->link(__('Purchased Lesson Editions Bundles'), 
			['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'indexActive'], 
			['class' => 'list-group-item list-group-item-action bg-secondary text-white '. ($this->request->controller == 'PurchasedLessonEditionsBundles' ? 'active' : '')]
		); 

	?>

</div>