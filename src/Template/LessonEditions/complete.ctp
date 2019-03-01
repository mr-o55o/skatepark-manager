<?php

?>

<div class=" content">
    <h3>
        <?= __('Complete Lesson Edition') ?> [<?= h($lesson_edition->id) ?>]
        <br><span class="small"><?= __('Mark this edition as completed, operation cannot be reverted') ?></span>

    </h3>
    <?= $this->Form->create($lesson_edition) ?>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Lesson') ?></th>
            <td><?= $lesson_edition->has('lesson') ? $this->Html->link($lesson_edition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lesson_edition->lesson->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Date') ?></th>
            <td><?= h($lesson_edition->event->start_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Start Time') ?></th>
            <td><?= h($lesson_edition->event->end_date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Status') ?></th>
            <td><?= $lesson_edition->has('lesson_edition_status') ? $this->Html->link($lesson_edition->lesson_edition_status->name, ['controller' => 'LessonStatuses', 'action' => 'view', $lesson_edition->lesson_edition_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Athlete') ?></th>
            <td><?= $lesson_edition->has('athlete') ? $this->Html->link($lesson_edition->athlete->name. ' '.$lesson_edition->athlete->surname , ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id]) : '' ?>
                
                <?php if ($lesson_edition->athlete->has('purchased_lesson_editions_bundles')) : ?>
                    <div class="alert alert-info">
                        <?= __('Athlete has a valid Lesson Editions Bundle with {0} editions remaining. 1 charge will be removed.', $lesson_edition->athlete->purchased_lesson_editions_bundles[0]->count ) ?>
                    </div>
                    <?= $this->Form->hidden('athlete.purchased_lesson_editions_bundles.0.id', ['value' => $lesson_edition->athlete->purchased_lesson_editions_bundles[0]->id] ); ?>
                <?php endif; ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trainer') ?></th>
            <td><?= $lesson_edition->has('user') ? $this->Html->link($lesson_edition->user->username, ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes') ?></th>
            <td><?= $this->Form->textarea('notes') ?></td>
        </tr>

        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($lesson_edition->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($lesson_edition->modified) ?></td>
        </tr>
    </table>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>