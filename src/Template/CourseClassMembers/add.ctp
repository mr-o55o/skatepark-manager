<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClassMember $courseClassMember
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Course Class Members'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Course Subscriptions'), ['controller' => 'CourseSubscriptions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Subscription'), ['controller' => 'CourseSubscriptions', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Course Classes'), ['controller' => 'CourseClasses', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Course Class'), ['controller' => 'CourseClasses', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="courseClassMembers form large-9 medium-8 columns content">
    <?= $this->Form->create($courseClassMember) ?>
    <fieldset>
        <legend><?= __('Add Course Class Member') ?></legend>
        <?php
            echo $this->Form->control('course_subscription_id', ['options' => $courseSubscriptions]);
            echo $this->Form->control('course_class_id', ['options' => $courseClasses]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
