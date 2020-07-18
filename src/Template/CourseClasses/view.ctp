<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClass $courseClass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course Class'), ['action' => 'edit', $courseClass->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course Class'), ['action' => 'delete', $courseClass->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseClass->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Course Classes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Class'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Periods'), ['controller' => 'CoursePeriods', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Period'), ['controller' => 'CoursePeriods', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Editions'), ['controller' => 'CourseEditions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Edition'), ['controller' => 'CourseEditions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Class Statuses'), ['controller' => 'CourseClassStatuses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Class Status'), ['controller' => 'CourseClassStatuses', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Class Members'), ['controller' => 'CourseClassMembers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Class Member'), ['controller' => 'CourseClassMembers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courseClasses view large-9 medium-8 columns content">
    <h3><?= h($courseClass->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($courseClass->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Period') ?></th>
            <td><?= $courseClass->has('course_period') ? $this->Html->link($courseClass->course_period->name, ['controller' => 'CoursePeriods', 'action' => 'view', $courseClass->course_period->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Edition') ?></th>
            <td><?= $courseClass->has('course_edition') ? $this->Html->link($courseClass->course_edition->name, ['controller' => 'CourseEditions', 'action' => 'view', $courseClass->course_edition->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Class Status') ?></th>
            <td><?= $courseClass->has('course_class_status') ? $this->Html->link($courseClass->course_class_status->name, ['controller' => 'CourseClassStatuses', 'action' => 'view', $courseClass->course_class_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($courseClass->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($courseClass->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($courseClass->modified) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Course Class Members') ?></h4>
        <?php if (!empty($courseClass->course_class_members)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Course Subscription Id') ?></th>
                <th scope="col"><?= __('Course Class Id') ?></th>
                <th scope="col"><?= __('Created') ?></th>
                <th scope="col"><?= __('Modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($courseClass->course_class_members as $courseClassMembers): ?>
            <tr>
                <td><?= h($courseClassMembers->id) ?></td>
                <td><?= h($courseClassMembers->course_subscription_id) ?></td>
                <td><?= h($courseClassMembers->course_class_id) ?></td>
                <td><?= h($courseClassMembers->created) ?></td>
                <td><?= h($courseClassMembers->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'CourseClassMembers', 'action' => 'view', $courseClassMembers->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'CourseClassMembers', 'action' => 'edit', $courseClassMembers->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'CourseClassMembers', 'action' => 'delete', $courseClassMembers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseClassMembers->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
