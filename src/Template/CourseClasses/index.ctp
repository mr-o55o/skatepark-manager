<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClass[]|\Cake\Collection\CollectionInterface $courseClasses
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Course Class'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Periods'), ['controller' => 'CoursePeriods', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Period'), ['controller' => 'CoursePeriods', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Editions'), ['controller' => 'CourseEditions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Edition'), ['controller' => 'CourseEditions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Class Statuses'), ['controller' => 'CourseClassStatuses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Class Status'), ['controller' => 'CourseClassStatuses', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Class Members'), ['controller' => 'CourseClassMembers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Class Member'), ['controller' => 'CourseClassMembers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseClasses index large-9 medium-8 columns content">
    <h3><?= __('Course Classes') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_period_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_edition_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_class_status_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courseClasses as $courseClass): ?>
            <tr>
                <td><?= $this->Number->format($courseClass->id) ?></td>
                <td><?= h($courseClass->name) ?></td>
                <td><?= $courseClass->has('course_period') ? $this->Html->link($courseClass->course_period->name, ['controller' => 'CoursePeriods', 'action' => 'view', $courseClass->course_period->id]) : '' ?></td>
                <td><?= h($courseClass->created) ?></td>
                <td><?= h($courseClass->modified) ?></td>
                <td><?= $courseClass->has('course_edition') ? $this->Html->link($courseClass->course_edition->name, ['controller' => 'CourseEditions', 'action' => 'view', $courseClass->course_edition->id]) : '' ?></td>
                <td><?= $courseClass->has('course_class_status') ? $this->Html->link($courseClass->course_class_status->name, ['controller' => 'CourseClassStatuses', 'action' => 'view', $courseClass->course_class_status->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $courseClass->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $courseClass->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $courseClass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseClass->id)]) ?>
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
