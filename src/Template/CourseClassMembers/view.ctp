<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClassMember $courseClassMember
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Course Class Member'), ['action' => 'edit', $courseClassMember->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Course Class Member'), ['action' => 'delete', $courseClassMember->id], ['confirm' => __('Are you sure you want to delete # {0}?', $courseClassMember->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Course Class Members'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Class Member'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Subscriptions'), ['controller' => 'CourseSubscriptions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Subscription'), ['controller' => 'CourseSubscriptions', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Course Classes'), ['controller' => 'CourseClasses', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Course Class'), ['controller' => 'CourseClasses', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="courseClassMembers view large-9 medium-8 columns content">
    <h3><?= h($courseClassMember->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Course Subscription') ?></th>
            <td><?= $courseClassMember->has('course_subscription') ? $this->Html->link($courseClassMember->course_subscription->id, ['controller' => 'CourseSubscriptions', 'action' => 'view', $courseClassMember->course_subscription->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Course Class') ?></th>
            <td><?= $courseClassMember->has('course_class') ? $this->Html->link($courseClassMember->course_class->name, ['controller' => 'CourseClasses', 'action' => 'view', $courseClassMember->course_class->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($courseClassMember->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($courseClassMember->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($courseClassMember->modified) ?></td>
        </tr>
    </table>
</div>
