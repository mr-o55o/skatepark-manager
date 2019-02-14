<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<div class="events content">
    <h3><?= __('View Activity Event') ?></h3>
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($event->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Event Id') ?></th>
            <td><?= $this->Number->format($event->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($event->end_date) ?></td>
        </tr>
    </table>
    <hr>
    <?php if ($event->has('activity')) : ?>
        <h3><?=__('Associated Activity Data')?></h3>
        <table class="table vertical-table table-striped">
            <tr>
                <th scope="row"><?= __('Activity Id') ?></th>
                <td><?= $event->activity->id ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Activity Type') ?></th>
                <td><?= $event->activity->activity_type->name ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Assigned Staff Member') ?></th>
                <td><?= $this->Html->link($event->activity->user->username, ['controller' => 'Users', 'action' => 'view', $event->activity->user->id]) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Notes') ?></th>
                <td><?= $event->activity->notes ?></td>    
            </tr>
        </table>

        <?= $this->element('Events/activity-event-details-menu') ?>
    <?php endif; ?>
</div>
