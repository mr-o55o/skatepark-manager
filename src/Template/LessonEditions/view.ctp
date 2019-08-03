<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */


?>

<div class="lesson_edition content">
    <h3><?= __('View Lesson Edition') ?></h3>
    <table class="table vertical-table table-striped">
        <tr>
            <th scope="row"><?= __('Lesson Edition Id') ?></th>
            <td><?= $lesson_edition->id ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Type') ?></th>
            <td><?= $this->Html->link(h($lesson_edition->lesson->name), ['controller' => 'lessons', 'action' => 'view', $lesson_edition->lesson->id]) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start') ?></th>
            <td><?= h($lesson_edition->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('End') ?></th>
            <td><?= h($lesson_edition->event->end_date) ?></td>
        </tr>      
        <tr>
            <th scope="row"><?= __('Lesson Edition Status') ?></th>
            <td><?= $this->element('LessonEditionStatuses/status-badge', ['statusId' => $lesson_edition->lesson_edition_status_id]); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Assigned Trainer') ?></th>
            <td><?= $lesson_edition->user ? $this->Html->link(h($lesson_edition->user->username), ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : '-'?></td>    
        </tr>
        <tr>
            <th scope="row"><?= __('Assigned Athlete') ?></th>
            <td>
            <?php if ($lesson_edition->athlete) : ?>
                <?= $this->Html->link(h($lesson_edition->athlete->name).' '.h($lesson_edition->athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id])?> 
                <p><?= __('ASI Subscription data: ') ?> # <?= $lesson_edition->athlete->asi_subscription_number ?> - <?= __('Date') ?> <?= $lesson_edition->athlete->asi_subscription_date ?></p>
                <?php if ($lesson_edition->athlete->asi_subscription_date->modify('+ 1 year') < $lesson_edition->event->start_date) : ?>
                    <div class="alert alert-warning"><?= __('ASI Subscription is due to expire before the lesson edition starts') ?></div>
                <?php endif; ?>
             <?php endif; ?>   
            </td>    
        </tr>
        <tr>
            <th scope="row"><?= __('Notes')?></th>
            <td><?= $this->Text->autoParagraph(h($lesson_edition->notes)); ?></td>
        </tr>
    </table>
    <?= $this->Element('LessonEditions/lesson-edition-detail-menu', ['status' => $lesson_edition->lesson_edition_status_id]); ?>
</div>
