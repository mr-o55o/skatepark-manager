<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonStatus $lessonEditionStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lesson Status'), ['action' => 'edit', $lessonEditionStatus->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lesson Status'), ['action' => 'delete', $lessonEditionStatus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonEditionStatus->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lesson Statuses'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson Status'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lesson Editions'), ['controller' => 'LessonEditions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson Edition'), ['controller' => 'LessonEditions', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lessonStatuses view large-9 medium-8 columns content">
    <h3><?= h($lessonEditionStatus->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($lessonEditionStatus->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lessonEditionStatus->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($lessonEditionStatus->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($lessonEditionStatus->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Description') ?></h4>
        <?= $this->Text->autoParagraph(h($lessonEditionStatus->description)); ?>
    </div>
    <div class="related">
        <h4><?= __('Related Lesson Editions') ?></h4>
        <?php if (!empty($lessonEditionStatus->lesson_editions)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Lesson Id') ?></th>
                <th scope="col"><?= __('Start Date') ?></th>
                <th scope="col"><?= __('Lesson Status Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($lessonEditionStatus->lesson_editions as $lessonEditions): ?>
            <tr>
                <td><?= h($lessonEditions->id) ?></td>
                <td><?= h($lessonEditions->lesson_id) ?></td>
                <td><?= h($lessonEditions->start_date) ?></td>
                <td><?= h($lessonEditions->lesson_status_id) ?></td>
                <td><?= h($lessonEditions->created) ?></td>
                <td><?= h($lessonEditions->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'LessonEditions', 'action' => 'view', $lessonEditions->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'LessonEditions', 'action' => 'edit', $lessonEditions->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'LessonEditions', 'action' => 'delete', $lessonEditions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonEditions->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
