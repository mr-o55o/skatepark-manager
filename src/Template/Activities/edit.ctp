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
                <?= $activity->has('user') ? $this->Html->link($activity->user->username, ['controller' => 'Users', 'action' => 'view', $activity->user->id]) : '' ?>
                <?= $this->Html->link('Cambia Responsabile', ['controller' => 'Activities', 'action' => 'changeUser', $activity->id], ['class' => 'btn btn-primary btn-sm']) ?>
            </td>
        </tr>
        <?php if  (count($activity->user_activities) > 0) : ?>
        <tr>
            <th scope="row"><?= __('Staff') ?></th>
            <td>
                <ul>
                <?php foreach ($activity->user_activities as $activity_user) : ?>
                    <li>
                        <?= $this->Html->link($activity_user->user->username, ['controller' => 'Users', 'action' => 'View', $activity_user->user->user_id]) ?> 
                        <?= $this->Form->postLink('Rimuovi', ['controller' => 'Activities', 'action' => 'removeAdditionalUser', $activity->id], ['class' => 'btn btn-primary btn-sm']) ?>
                    </li>
                <?php endforeach ?> 
                <hr>
                <?= $this->Html->link('Aggiungi Staff', ['controller' => 'Activities', 'action' => 'addAdditionalUser', $activity->id], ['class' => 'btn btn-primary btn-sm']) ?>            
            </td>
        </tr> 
        <?php endif ?>  
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

