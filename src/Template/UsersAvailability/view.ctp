<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersAvailability $usersAvailability
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Availability'), ['action' => 'edit', $usersAvailability->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Availability'), ['action' => 'delete', $usersAvailability->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersAvailability->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Availability'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Availability'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersAvailability view large-9 medium-8 columns content">
    <h3><?= h($usersAvailability->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $usersAvailability->has('user') ? $this->Html->link($usersAvailability->user->username, ['controller' => 'Users', 'action' => 'view', $usersAvailability->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersAvailability->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Day') ?></th>
            <td><?= h($usersAvailability->day) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($usersAvailability->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($usersAvailability->modified) ?></td>
        </tr>
    </table>
</div>
