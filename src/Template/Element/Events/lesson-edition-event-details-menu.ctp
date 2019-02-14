<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">
<?php if ($status === Configure::read('lesson_edition_statuses')['draft']) : ?>
	TO-DO
<?php endif; ?>
<?php if ($status === Configure::read('lesson_edition_statuses')['scheduled']) : ?>
	<li class="nav-item"><?= $this->Html->link('Edit Lesson Edition Event', ['controller' => 'LessonEditions', 'action' => 'edit', $event->lesson_edition->id], ['class' => 'nav-link'])?></li>
    <li class="nav-item"><?= $this->Form->postLink('Delete Lesson Edition Event', ['controller' => 'Events', 'action' => 'delete', $event->id], ['class' => 'nav-link'])?></li>
<?php endif; ?>

<?php if ($status === Configure::read('lesson_edition_statuses')['booked']) : ?>
	<li class="nav-item"><?= $this->Html->link('Edit Lesson Edition Event', ['controller' => 'LessonEditions', 'action' => 'edit', $event->lesson_edition->id], ['class' => 'nav-link'])?></li>
    <li class="nav-item"><?= $this->Html->link('Complete Lesson Edition Event', ['controller' => 'LessonEditions', 'action' => 'close', $event->lesson_edition->id], ['class' => 'nav-link'])?></li>
    <li class="nav-item"><?= $this->Html->link('Cancel Lesson Edition Event', ['controller' => 'LessonEditions', 'action' => 'cancel', $event->lesson_edition->id], ['class' => 'nav-link'])?></li>
<?php endif; ?> 

<?php if ($status === Configure::read('lesson_edition_statuses')['completed']) : ?>
	TO-DO
<?php endif; ?>

<?php if ($status === Configure::read('lesson_edition_statuses')['cancelled-staff']) : ?>
	TO-DO
<?php endif; ?>

<?php if ($status === Configure::read('lesson_edition_statuses')['cancelled-athlete']) : ?>
	TO-DO
<?php endif; ?>

</ul>


