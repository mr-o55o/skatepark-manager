<?php
Use Cake\Core\Configure;
?>


    <?php if (count($lessonEditions) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lesson_id', __('Lesson type')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Event.start_date', __('Date')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lesson_edition_status_id', __('Status')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('ahtlete_id', __('Athlete')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id', __('Trainer')) ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessonEditions as $lessonEdition): ?>
                <tr>
                    <td><?= $this->Number->format($lessonEdition->id) ?></td>
                    <td><?= $lessonEdition->has('lesson') ? $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) : '' ?></td>
                    <td><? $lessonEdition->has('event') ? h($lessonEdition->event->start_date->i18nFormat("EE d MMMM H:mm")) : '' ?></td>
                    <td><?= $lessonEdition->has('lesson_edition_status') ? $this->Html->link($lessonEdition->lesson_edition_status->name, ['controller' => 'LessonStatuses', 'action' => 'view', $lessonEdition->lesson_edition_status->name]) : '' ?></td>
                    <td><?= $lessonEdition->has('athlete') ? $this->Html->link($lessonEdition->athlete->name . ' ' . $lessonEdition->athlete->surname . ' (' . $lessonEdition->athlete->asi_subscription_number. ')', ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->athlete->id]) : '' ?></td>
                    <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->name . ' ' . $lessonEdition->user->surname, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
                    <td class="actions">
                        <div class="btn-group">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $lessonEdition->id], ['class' => 'btn btn-info']) ?>
                        <?php if ($lessonEdition->lesson_edition_status_id === Configure::read('lesson_edition_statuses')['booked']) : ?>
                            <?= $this->Html->link(__('Edit Booking'), ['action' => 'editBooked', $lessonEdition->id], ['class' => 'btn btn-primary']) ?>
                            <?= $this->Html->link(__('Complete'), ['action' => 'close', $lessonEdition->id], ['class' => 'btn btn-success']) ?>
                            <?= $this->Html->link(__('Cancel'), ['action' => 'cancel', $lessonEdition->id], ['class' => 'btn btn-warning']) ?>
                        <?php endif ?>
                        <?php if ($lessonEdition->lesson_edition_status_id === Configure::read('lesson_edition_statuses')['scheduled']) : ?>
                            <?= $this->Html->link(__('Book'), ['action' => 'book', $lessonEdition->id], ['class' => 'btn btn-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lessonEdition->id], ['class' => 'btn btn-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $lessonEdition->id)]) ?>
                        <?php endif ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('first')) ?>
                <?= $this->Paginator->prev('< ' . __('previous')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('next') . ' >') ?>
                <?= $this->Paginator->last(__('last') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
        </div>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No lesson editions found :(') ?></div>
    <?php endif ?>