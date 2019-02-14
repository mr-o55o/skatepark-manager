<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonStatus[]|\Cake\Collection\CollectionInterface $lessonStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Lesson Status'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lesson Editions'), ['controller' => 'LessonEditions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lesson Edition'), ['controller' => 'LessonEditions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lessonStatuses index large-9 medium-8 columns content">
    <h3><?= __('Lesson Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessonEditionStatuses as $lessonEditionStatus): ?>
            <tr>
                <td><?= $this->Number->format($lessonEditionStatus->id) ?></td>
                <td><?= h($lessonEditionStatus->name) ?></td>
                <td><?= h($lessonEditionStatus->created) ?></td>
                <td><?= h($lessonEditionStatus->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lessonEditionStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lessonEditionStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lessonEditionStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonEditionStatus->id)]) ?>
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
</div>
