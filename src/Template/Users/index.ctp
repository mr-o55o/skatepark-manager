<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */

use Cake\Time\I18n;
?>
<div class="users index content">
    <div class="container">
        <div class="row">
            <div class="col"><h4><?= __('Users List') ?></h4></div>
            <div class="col"><?= $this->Element('Users/filter-form') ?></div>
        </div>
    </div>
    
    <table class="table table-striped table-sm">
        <thead class="thead">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('role_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal_code') ?></th>
                <th scope="col"><?= $this->Paginator->sort('active') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Html->link($this->Number->format($user->id), ['action' => 'view', $user->id]) ?></td>
                <td><?= h($user->username) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->surname) ?></td>
                <td><?= $user->birthdate->i18nFormat('dd/M/YYY') ?></td>
                <td><?= h($user->fiscal_code) ?></td>
                <td><?= h($user->active) ?></td>
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
