<?php
Use Cake\Core\Configure;
$this->loadHelper('Calendar.Calendar');
?>

<ul class="nav justify-content-center">
	<li class="nav-item p-2"><?= $this->Html->link(__('Aggiungi giornate di disponibilità in un periodo'), ['controller' => 'UsersAvailability', 'action' => 'addMultiple'], ['class' => 'btn btn-primary']) ?></li>
</ul>

<?php
foreach($usersAvailability as $userAvailability) {
	
	$content = '<div class="rounded bg-secondary text-white mb-1 p-1 clearfix"><strong>'.$userAvailability->user->username.'</strong> ';
	$content .= ($userAvailability->end_date->isFuture() ? $this->Form->postLink('<i class="fa fa-trash"></i>', ['action' => 'delete', $userAvailability->id], ['escape' => false, 'confirm' => 'Eliminare la disponibilità di '.$userAvailability->user->username.' per il giorno '.$userAvailability->start_date.'?', 'class' => 'btn btn-danger btn-sm text-white float-right']) : '');
	$content .= '</div>';

	$this->Calendar->addRow($userAvailability->start_date, $content, []);	
}
echo $this->Calendar->render();
?>
<?php if (!$this->Calendar->isCurrentMonth()) { ?>
	<?php echo $this->Html->link(__('Go to current month'), ['action' => 'calendar'])?>
<?php } ?>
