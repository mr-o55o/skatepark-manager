<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\CourseClass $courseClass
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Course Classes'), ['action' => 'index']) ?></li>
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
<div class="courseClasses form large-9 medium-8 columns content">
    <?= $this->Form->create($courseClass) ?>
    <fieldset>
        <legend><?= __('Add Course Class') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('course_period_id', ['options' => $coursePeriods]);
            echo $this->Form->control('course_edition_id', ['options' => $courseEditions]);
            echo $this->Form->control('course_class_status_id', ['options' => $courseClassStatuses, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
