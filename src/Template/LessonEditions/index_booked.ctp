<?php
use Cake\Core\Configure;
?>

<div class="lessonEditions index content">
    <h4><?= __('Booked Lesson Editions') ?></h4>
    <?= $this->Element('Athletes/filter-form'); ?>
    <?php if (count($lessonEditions) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= __('Lesson type') ?></th>
                    <th scope="col"><?= __('Start date') ?></th>
                    <th scope="col"><?= __('Trainer') ?></th>
                    <th scope="col"><?= __('Athlete') ?></th>
                    <th scope="col"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessonEditions as $lessonEdition): ?>
                <tr>
                    <td><?= $this->Html->link($lessonEdition->id, ['action' => 'view', $lessonEdition->id]) ?></td>
                    <td><?= $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) ?></td>
                    <td><?= $lessonEdition->has('event') ? h($lessonEdition->event->start_date->i18nFormat("dd/MM/Y H:mm")) : '' ?></td>
                    <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->username, ['controller' => 'Users', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
                    <td><?= $lessonEdition->has('athlete') ? $this->Html->link($lessonEdition->athlete->name . ' ' . $lessonEdition->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->athlete->id]) : '' ?></td>
                    <td>
                            <?= $this->Html->link(__('Complete'), ['action' => 'complete', $lessonEdition->id], ['class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link(__('Cancel'), ['action' => 'cancel', $lessonEdition->id], ['class' => 'btn btn-danger']) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No lesson editions found :(') ?></div>
    <?php endif ?>
</div>
