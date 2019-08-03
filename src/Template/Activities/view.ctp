<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>

<div class="lesson_edition content">
    <hr>
    <div class="text-right">
        <?= $this->Html->link('Modifica', ['action' => 'edit', $activity->id], ['class' => 'btn btn-primary']) ?>
        <?= $this->Html->link('Annulla', ['action' => 'cancel', $activity->id], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
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
            <th scope="row"><?= __('Inizio') ?></th>
            <td><?= h($activity->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fine') ?></th>
            <td><?= h($activity->event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Responsabile') ?></th>
            <td><?= $activity->has('user') ? $this->Html->link($activity->user->name, ['controller' => 'Users', 'action' => 'view', $activity->user->id]) : '' ?></td>
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
</div>
