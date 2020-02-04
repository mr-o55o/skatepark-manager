<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AthletesNote $athletesNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $athletesNote->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $athletesNote->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Athletes Notes'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Athletes'), ['controller' => 'Athletes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Athlete'), ['controller' => 'Athletes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="athletesNotes form large-9 medium-8 columns content">
    <?= $this->Form->create($athletesNote) ?>
    <fieldset>
        <legend><?= __('Edit Athletes Note') ?></legend>
        <?php
            echo $this->Form->control('athlete_id', ['options' => $athletes]);
            echo $this->Form->control('note');
            echo $this->Form->control('user_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
