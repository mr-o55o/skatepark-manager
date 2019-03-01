<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundlesStatus[]|\Cake\Collection\CollectionInterface $purchasedLessonEditionsBundlesStatuses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Purchased Lesson Editions Bundles Status'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="purchasedLessonEditionsBundlesStatuses index large-9 medium-8 columns content">
    <h3><?= __('Purchased Lesson Editions Bundles Statuses') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasedLessonEditionsBundlesStatuses as $purchasedLessonEditionsBundlesStatus): ?>
            <tr>
                <td><?= $this->Number->format($purchasedLessonEditionsBundlesStatus->id) ?></td>
                <td><?= h($purchasedLessonEditionsBundlesStatus->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchasedLessonEditionsBundlesStatus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchasedLessonEditionsBundlesStatus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $purchasedLessonEditionsBundlesStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchasedLessonEditionsBundlesStatus->id)]) ?>
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
