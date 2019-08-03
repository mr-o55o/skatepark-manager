<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Activities'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Activity Types'), ['controller' => 'ActivityTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Activity Type'), ['controller' => 'ActivityTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="activities form large-9 medium-8 columns content">
    <?= $this->Form->create($activity) ?>
    <fieldset>
        <legend><?= __('Add Activity') ?></legend>
        <?php
            echo $this->Form->control('user_id', ['options' => $users]);
            echo $this->Form->control('activity_type_id', ['options' => $activityTypes]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
