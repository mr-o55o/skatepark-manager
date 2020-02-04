<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>

<div class="activity content">
    <hr>
    <div class="text-right">
        <?= $this->Html->link('Modifica', ['action' => 'edit', $activity->id], ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Annulla', ['action' => 'cancel', $activity->id], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?= $this->Form->create($activity) ?>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tipo Attività') ?></th>
            <td><?= $activity->has('activity_type') ? $this->Html->link($activity->activity_type->name, ['controller' => 'ActivityTypes', 'action' => 'view', $activity->activity_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Titolo Evento') ?></th>
            <td><?= $activity->has('activity_type') ? $this->Html->link($activity->activity_type->name, ['controller' => 'ActivityTypes', 'action' => 'view', $activity->activity_type->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Status') ?></th>
            <td><?= $activity->has('activity_status') ? $this->Html->link($activity->activity_status->name, ['controller' => 'ActivityTypes', 'action' => 'view', $activity->activity_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Inizio') ?></th>
            <td><?= h($activity->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= h($activity->event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsabile') ?></th>
            <td>
                <?= $this->Form->control('user_id', ['options' => $users, 'label' => false])?>
            </td>
        </tr>  
        <tr>
            <th scope="row"><?= __('Creato') ?></th>
            <td><?= h($activity->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modificato') ?></th>
            <td><?= h($activity->modified) ?></td>
        </tr>
    </table>
    <?= $this->Form->button('Submit') ?>
    <?= $this->Form->end() ?>
</div>

