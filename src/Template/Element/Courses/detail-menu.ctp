<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">
<?php if ($this->request->action == 'view') : ?>

	<?php if ($status === Configure::read('course_statuses')['draft']) : ?>
		<li class="nav-item"><?= $this->Html->link(__('Modifica'), ['controller' => 'Courses', 'action' => 'edit', $course->id], ['class' => 'nav-link']) ?></li>
	    <li class="nav-item"><?= $this->Form->postLink(__('Pianifica'), ['controller' => 'Courses', 'action' => 'schedule', $course->id], ['confirm' => __('Pianificare il corso? Verranno create le sessioni previste nel periodo di durata del corso.'), 'class' => 'nav-link'])?></li>
	   	<li class="nav-item"><?= $this->Form->postLink(__('Elimina'), ['controller' => 'Courses', 'action' => 'delete', $course->id], ['confirm' => __('Eliminare il Corso?'), 'class' => 'nav-link'])?></li>
	<?php endif; ?>

	<?php if ($status === Configure::read('course_statuses')['scheduled']) : ?>
		<li class="nav-item"><?= $this->Form->postLink(__('Attiva'), ['controller' => 'Courses', 'action' => 'activate', $course->id], ['confirm' => __('Attivare il corso?'), 'class' => 'nav-link']) ?></li>
		<li class="nav-item"><?= $this->Form->postLink(__('Annulla'), ['controller' => 'Courses', 'action' => 'cancel', $course->id], ['confirm' => __('Annullare il corso?'), 'class' => 'nav-link']) ?></li>
	<?php endif; ?>

	<?php if ($status === Configure::read('course_statuses')['active']) : ?>
		<li class="nav-item"><?= $this->Html->link(__('Completa'), ['controller' => 'Courses', 'action' => 'complete', $course->id], ['class' => 'nav-link']) ?></li>
		<li class="nav-item"><?= $this->Html->link(__('Cancella'), ['controller' => 'Courses', 'action' => 'cancel', $course->id], ['class' => 'nav-link']) ?></li>
	<?php endif; ?>

<?php endif ?>
</ul>