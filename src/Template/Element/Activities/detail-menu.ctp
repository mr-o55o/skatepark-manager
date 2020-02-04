<?php
//build action menu based on lesson edition status
use Cake\Core\Configure;
?>

<ul class="nav justify-content-center">

<?php if ($status === Configure::read('activity_statuses')['draft']) : ?>
 	<li class="nav-item"><?= $this->Form->postLink(__('Pianifica'), ['controller' => 'Activities', 'action' => 'schedule', $activity->id], ['confirm' => __('Pianificare questa attivià?'), 'class' => 'nav-link'])?></li>
 	<li class="nav-item"><?= $this->Form->postLink(__('Elimina'), ['controller' => 'Activities', 'action' => 'delete', $activity->id], ['confirm' => 'Eliminare questa attività?', 'class' => 'nav-link'])?></li>
<?php endif; ?>

<?php if ($status === Configure::read('activity_statuses')['scheduled']) : ?>
	<li class="nav-item"><?= $this->Html->link(__('Completa Attivitò'), ['controller' => 'Activities', 'action' => 'complete', $activity->id], ['class' => 'nav-link'])?></li>
	<li class="nav-item"><?= $this->Html->link(__('Cancella Attività'), ['controller' => 'Activities', 'action' => 'cancel', $activity->id], ['class' => 'nav-link'])?></li>
<?php endif; ?>

</ul>