<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">
<?php if ($this->request->action == 'view') : ?>
	<?php if ($status === Configure::read('lesson_edition_statuses')['booked']) : ?>
	    <li class="nav-item"><?= $this->Html->link('Completa', ['controller' => 'LessonEditions', 'action' => 'complete', $lesson_edition->id], ['class' => 'nav-link'])?></li>
	    <li class="nav-item"><?= $this->Html->link('Cancella', ['controller' => 'LessonEditions', 'action' => 'cancel', $lesson_edition->id], ['class' => 'nav-link'])?></li>
	<?php endif; ?>

	<?php if ($status === Configure::read('lesson_edition_statuses')['trainer-assigned']) : ?>
	    <li class="nav-item"><?= $this->Form->postLink('Delete', ['controller' => 'LessonEditions', 'action' => 'delete', $lesson_edition->id], ['confirm' => __('Eliminare questa edizione?'), 'class' => 'nav-link'])?></li>
	<?php endif; ?> 
<?php endif ?>

<?php if ($this->request->action == 'bookForAthlete') : ?>
	<li class="nav-item"><?= $this->Html->link('Torna all\'edizione', ['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id], ['class' => 'nav-link'])?></li>
<?php endif ?>

<?php if ($this->request->action == 'complete') : ?>
	<li class="nav-item"><?= $this->Html->link('Torna all\'edizione', ['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id], ['class' => 'nav-link'])?></li>
<?php endif ?>

<?php if ($this->request->action == 'changeTrainer') : ?>
	<li class="nav-item"><?= $this->Html->link('Torna all\'edizione', ['controller' => 'LessonEditions', 'action' => 'view', $lesson_edition->id], ['class' => 'nav-link'])?></li>
<?php endif ?>
</ul>