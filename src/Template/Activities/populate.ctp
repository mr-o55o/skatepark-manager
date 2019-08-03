<?php
//$this->Form->unlockField('athlete_id');
?>
<table class="table table-striped">
    <tr>
        <th><?= __('Attività') ?></th>
        <td><?= h($activity->activity_type->name)?></td>
    </tr>
    <tr>
        <th><?= __('Inizio') ?></th>
        <td><?= $activity->event->start_date->I18nFormat('EEEE d MMMM Y') ?> @ <?= $activity->event->start_date->I18nFormat('HH:mm') ?></td>
    </tr>
    <tr>
        <th><?= __('Fine') ?></th>
        <td><?= $activity->event->end_date->I18nFormat('EEEE d MMMM Y') ?> @ <?= $activity->event->end_date->I18nFormat('HH:mm') ?></td>
    </tr>
</table>
<?= $this->Form->create($activity) ?>
	<?php if ($available_users) : ?>
        <label><?= __('Seleziona uno dei membri dello staff come responsabile per questa attività.') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
		<?= $this->Form->control('user_id', ['options' => $available_users, 'label' => false])?>
	<?php else : ?>
		<div class="alert alert-warning"><?= __('No free users for the selected timeframe') ?></div>
	<?php endif; ?>
    <hr>

    <?= $this->Html->link(__('Back'), $ref, ['class' => 'btn btn-primary']) ?>
	<?= $this->Form->submit('Programma attività'); ?>
<?= $this->Form->end() ?>
