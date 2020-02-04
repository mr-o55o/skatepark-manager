<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">
<?php if ($this->request->action == 'view') : ?>
	<?php if ($status === Configure::read('course_statuses')['draft']) : ?>
		<li class="nav-item"><?= $this->Html->link(__('Modifica'), ['controller' => 'Courses', 'action' => 'edit', $course->id], ['class' => 'nav-link']) ?></li>
	    <li class="nav-item"><?= $this->Form->postLink(__('Pianifica'), ['controller' => 'Courses', 'action' => 'schedule', $course->id], ['confirm' => __('Pianificare il corso? Verranno create le sessioni previste nel periodo di durata del corso.'), 'class' => 'nav-link'])?></li>
	<?php endif; ?>
<?php endif ?>
</ul>