<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClassMember[]|\Cake\Collection\CollectionInterface $courseClassMembers
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Course Class Member'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Subscriptions'), ['controller' => 'CourseSubscriptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Subscription'), ['controller' => 'CourseSubscriptions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Classes'), ['controller' => 'CourseClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Class'), ['controller' => 'CourseClasses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseClassMembers index large-9 medium-8 columns content">
    <h3><?= __('Course Class Members') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_subscription_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('course_class_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courseClassMembers as $courseClassMember): ?>
            <tr>
                <td><?= $this->Number->format($courseClassMember->id) ?></td>
                <td><?= $courseClassMember->has('course_subscription') ? $this->Html->link($courseClassMember->course_subscription->id, ['controller' => 'CourseSubscriptions', 'action' => 'view', $courseClassMember->course_subscription->id]) : '' ?></td>
                <td><?= $courseClassMember->has('course_class') ? $this->Html->link($courseClassMember->course_class->name, ['controller' => 'CourseClasses', 'action' => 'view', $courseClassMember->course_class->id]) : '' ?></td>
                <td><?= h($courseClassMember->created) ?></td>
                <td><?= h($courseClassMember->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $courseClassMember->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $courseClassMember->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $courseClassMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseClassMember->id)]) ?>
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
