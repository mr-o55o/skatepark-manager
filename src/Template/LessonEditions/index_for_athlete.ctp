<?php

?>
<div class="lessonEditions index content">
    <h3>
        <?= __('Lesson Management') ?> - <?= __('All lesson editions involving') ?> <?= h($athlete->name) ?> <?= h($athlete->surname) ?> 
    </h3>
    <small><?= __('...') ?></small>
    <div class="text-right">
    	<?= $this->Html->link(__('View Athlete'), ['controller' => 'Athletes', 'action' => 'view', $athlete->id], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?php if (count($lessonEditions) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lesson_id', __('Lesson type')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('Event.start_date', __('Date')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lesson_edition_status_id', __('Status')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('user_id', __('Trainer')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessonEditions as $lessonEdition): ?>
                <tr>
                    <td><?= $this->Html->link($lessonEdition->id, ['action' => 'view', $lessonEdition->id]) ?></td>
                    <td><?= $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) ?></td>
                    <td><?= $lessonEdition->has('event') ? h($lessonEdition->event->start_date->i18nFormat("dd/MM/Y H:mm")) : '' ?></td>
                    <td><?= $lessonEdition->lesson_edition_status->name ?></td>
                    <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->name . ' ' . $lessonEdition->user->surname, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
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
</div>