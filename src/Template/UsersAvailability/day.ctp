<?php
use Cake\Core\Chronos;
?>
<h3><?= __('Disponibilità dei membri dello staff per il giorno') ?> <?= $current_day->i18nFormat('EEEE d MMMM Y'); ?></h3>

<table class="table table-striped">
	<thead>
		<tr>
			<th><?= __('User') ?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($usersAvailabilities as $userAvailability) : ?>
		<tr>
			<td><?= h($userAvailability->user->username) ?></td>
			<td><?= ($userAvailability->end_date->isFuture() ? $this->Form->postLink(__('Elimina'), ['action' => 'delete', $userAvailability->id], ['escape' => false, 'confirm' => 'Eliminare la disponibilità di '.$userAvailability->user->username.' per il giorno '.$userAvailability->start_date.'?', 'class' => 'btn btn-warning btn-sm pull-right']) : '')?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?= $this->Html->Link(__('Aggiungi disponibilità per la giornata'), ['action' => 'addForDay', 'day' => $current_day->i18nFormat('dd/MM/YYYY')], ['class' => 'btn btn-primary']) ?>
<br>
<?= $this->Html->link(__('Back'), $back_url)?>