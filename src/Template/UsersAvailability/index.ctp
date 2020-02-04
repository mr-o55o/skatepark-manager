<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\UsersAvailability[]|\Cake\Collection\CollectionInterface $usersAvailability
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Availability'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersAvailability index large-9 medium-8 columns content">
    <h3><?= __('Users Availability') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('day') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersAvailability as $usersAvailability): ?>
            <tr>
                <td><?= $this->Number->format($usersAvailability->id) ?></td>
                <td><?= $usersAvailability->has('user') ? $this->Html->link($usersAvailability->user->username, ['controller' => 'Users', 'action' => 'view', $usersAvailability->user->id]) : '' ?></td>
                <td><?= h($usersAvailability->day) ?></td>
                <td><?= h($usersAvailability->created) ?></td>
                <td><?= h($usersAvailability->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersAvailability->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersAvailability->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersAvailability->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersAvailability->id)]) ?>
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
