<?php

?>
<div class="activity_users content">
    <?= ($activityUser->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $activityUser->getErrors() ]) : '' ) ?>

    <p>
        Per aggiungere un membro dello staff ad una attività creata in precedenza:
        <ol>
            <li>Selezionare uno dei membri dello staff, vengono mostrati solo quelli non coinvolti in altre attività contemporanee a quella corrente.</li>
            <li>Opzionalmente, digitare il compito/ruolo assegnato al membro dello staff.</li>
        </ol>
    </p>
<?= $this->Html->link('Torna all\'Attività '.$activity_id, ['controller' => 'Activities', 'action' => 'view', $activity_id]) ?>
<hr>
<?= $this->Form->create($activityUser)?>
    <label><?= __('Seleziona uno dei membri dello staff.') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
	<?= $this->Form->control('user_id', ['options' => $availableUsers, 'label' => false])?>
	<?=$this->Form->input('task', ['label' => 'Compito da svolegere'])?>
	<?= $this->Form->button('Submit'); ?>

<?= $this->Form->end() ?>
</ldiv>