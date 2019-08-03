<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity[]|\Cake\Collection\CollectionInterface $activities
 */
?>
<div class="activities content">

    <?= $this->Element('Activities/page-header') ?>

    <div class="col"><?= $this->Element('Users/filter-form'); ?></div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= __('Data inizio') ?></th>
                <th scope="col"><?= __('Data fine') ?></th>
                <th scope="col"><?= __('id') ?></th>
                <th scope="col"><?= __('User') ?></th>
                <th scope="col"><?= __('Attività') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($activities as $activity): ?>
            <tr>
                <td><?= h($activity->event->start_date) ?></td>
                <td><?= h($activity->event->end_date) ?></td>
                <td><?= $this->Number->format($activity->id) ?></td>
                <td><?= $activity->has('user') ? $this->Html->link($activity->user->name, ['controller' => 'Users', 'action' => 'view', $activity->user->id]) : '' ?></td>
                <td><?= $activity->has('activity_type') ? $this->Html->link($activity->activity_type->name, ['controller' => 'ActivityTypes', 'action' => 'view', $activity->activity_type->id]) : '' ?></td>
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
</div>
