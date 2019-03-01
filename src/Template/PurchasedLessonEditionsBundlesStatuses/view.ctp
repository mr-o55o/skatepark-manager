<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundlesStatus $purchasedLessonEditionsBundlesStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Purchased Lesson Editions Bundles Status'), ['action' => 'edit', $purchasedLessonEditionsBundlesStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Purchased Lesson Editions Bundles Status'), ['action' => 'delete', $purchasedLessonEditionsBundlesStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $purchasedLessonEditionsBundlesStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Purchased Lesson Editions Bundles Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Purchased Lesson Editions Bundles Status'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="purchasedLessonEditionsBundlesStatuses view large-9 medium-8 columns content">
    <h3><?= h($purchasedLessonEditionsBundlesStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($purchasedLessonEditionsBundlesStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($purchasedLessonEditionsBundlesStatus->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($purchasedLessonEditionsBundlesStatus->description)); ?>
    </div>
</div>
