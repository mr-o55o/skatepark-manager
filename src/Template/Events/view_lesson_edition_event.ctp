<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<div class="events content">
    <h3><?= __('View Lesson Edition Event') ?></h3>
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
    <?php if ($event->has('lesson_edition')) : ?>
        <h3><?=__('Associated Lesson Edition Data')?></h3>
        <table class="table vertical-table table-striped">
            <tr>
                <th scope="row"><?= __('Lesson Edition Id') ?></th>
                <td><?= $event->lesson_edition->id ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Lesson Edition Status') ?></th>
                <td><?= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $event->lesson_edition->lesson_edition_status_id]); ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Lesson Type') ?></th>
                <td><?= $this->Html->link(h($event->lesson_edition->lesson->name), ['controller' => 'lessons', 'action' => 'view', $event->lesson_edition->lesson->id]) ?></td>
            </tr>
            <tr>
                <th scope="row"><?= __('Assigned Trainer') ?></th>
                <td><?= $event->lesson_edition->user ? $this->Html->link(h($event->lesson_edition->user->username), ['controller' => 'Users', 'action' => 'view', $event->lesson_edition->user->id]) : '-'?></td>    
            </tr>
            <tr>
                <th scope="row"><?= __('Assigned Athlete') ?></th>
                <td>
                <?php if ($event->lesson_edition->athlete) : ?>
                    <?= $this->Html->link(h($event->lesson_edition->athlete->name).' '.h($event->lesson_edition->athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $event->lesson_edition->athlete->id])?> 
                    <p><?= __('ASI Subscription data: ') ?> # <?= $event->lesson_edition->athlete->asi_subscription_number ?> - <?= __('Date') ?> <?= $event->lesson_edition->athlete->asi_subscription_date ?></p>
                    <?php if ($event->lesson_edition->athlete->asi_subscription_date->modify('+ 1 year') < $event->start_date) : ?>
                        <div class="alert alert-warning"><?= __('ASI Subscription is due to expire before the lesson edition starts') ?></div>
                    <?php endif; ?>
                 <?php endif; ?>   
                </td>    
            </tr>
            <tr>
                <th scope="row"><?= __('Notes')?></th>
                <td><?= $this->Text->autoParagraph(h($event->lesson_edition->notes)); ?></td>
            </tr>
        </table>
        <hr>
        <?=  $this->element('Events/lesson-edition-event-details-menu', ['status' => $event->lesson_edition->lesson_edition_status_id])?>
    <?php endif ?>
</div>
