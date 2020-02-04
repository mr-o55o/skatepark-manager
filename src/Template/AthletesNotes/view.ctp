<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AthletesNote $athletesNote
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Athletes Note'), ['action' => 'edit', $athletesNote->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Athletes Note'), ['action' => 'delete', $athletesNote->id], ['confirm' => __('Are you sure you want to delete # {0}?', $athletesNote->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Athletes Notes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Athletes Note'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Athletes'), ['controller' => 'Athletes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Athlete'), ['controller' => 'Athletes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="athletesNotes view large-9 medium-8 columns content">
    <h3><?= h($athletesNote->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Athlete') ?></th>
            <td><?= $athletesNote->has('athlete') ? $this->Html->link($athletesNote->athlete->name, ['controller' => 'Athletes', 'action' => 'view', $athletesNote->athlete->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $athletesNote->has('user') ? $this->Html->link($athletesNote->user->username, ['controller' => 'Users', 'action' => 'view', $athletesNote->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($athletesNote->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($athletesNote->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($athletesNote->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Note') ?></h4>
        <?= $this->Text->autoParagraph(h($athletesNote->note)); ?>
    </div>
</div>
