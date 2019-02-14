<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonStatus $lessonStatus
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Lesson Edition Statuses'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lesson Editions'), ['controller' => 'LessonEditions', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Lesson Edition'), ['controller' => 'LessonEditions', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="lessonStatuses form large-9 medium-8 columns content">
    <?= $this->Form->create($lessonEditionStatus) ?>
    <fieldset>
        <legend><?= __('Add Lesson Status') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
