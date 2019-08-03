<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lesson_edition
 */


?>

<?= $this->Form->create($lesson_edition); ?>
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
            <th scope="row"><?= __('End Date') ?></th>
            <td><?= h($lesson_edition->event->end_date) ?></td>
        </tr>
        <?php if ($lesson_edition->has('athlete')) : ?>
        <tr>
            <th scope="row"><?= __('Athlete') ?></th>
            <td><?= $this->Html->link($lesson_edition->athlete->name.' '.$lesson_edition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lesson_edition->athlete->id]) ?>
                <?php if ($lesson_edition->athlete->asi_subscription_date->modify('+ 1 year') < $lesson_edition->event->start_date) : ?>
                    <div class="alert alert-warning"><?= __('ASI Subscription expires before the lesson edition') ?></div>
                <?php endif; ?>

                <?php if(isset($valid_bundle['0'])): ?>
                    <div class="alert alert-info">
                        <?= __('Athlete has a valid lesson edition bundle, this lesson will use 1 charge.') ?>
                        <ul>
                            <li><?= __('Status')?>: <?= $valid_bundle[0]['purchased_lesson_editions_bundles_status']['name'] ?></li>
                            <li><?= __('Start date')?>: <?= $valid_bundle[0]['start_date'] ?></li>
                            <li><?= __('End date')?>: <?= $valid_bundle[0]['end_date'] ?></li>
                            <li><?= __('Charges') ?>: <?= $valid_bundle[0]['count'] ?></li>
                        </ul>
                    </div>
                <?php endif ?>
                <?php if (isset($busy_athlete_warning)) : ?>
                    <div class="alert alert-danger"><?= __('Athlete is busy in other activities, lesson edition cannot be saved') ?></div>
                <?php endif; ?>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <th scope="row"><?= __('Trainer') ?></th>
            <td><?= $lesson_edition->has('user') ? $this->Html->link($lesson_edition->user->username, ['controller' => 'Users', 'action' => 'view', $lesson_edition->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Notes') ?></th>
            <td> 
                <label><?= __('Optionally add some notes') ?></label>
                <?= $this->Form->textArea('notes'); ?>
            </td>
        </tr>
    </table>

    <?= $this->Html->link(__('Back'), ['action' => 'populate'], ['class' => 'btn btn-primary']) ?>
    <?= $this->Form->submit(__('Save lesson edition')); ?>
</div>
<?= $this->Form->end() ?>