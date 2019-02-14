<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="users view content">
    <h3><?= __('User Management') ?> - <?= __('View user details for')?> <?=h($user->username) ?></h3>
    <table class="vertical-table">
        <tr>
            <th colspan=""2"><h2><?= __('Anagraphical info')?></h2></th>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($user->surname) ?></td>
        </tr>
        <tr>
            <th colspan=""2"><h2><?= __('Contacts')?></h2></th>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Address') ?></th>
            <td><?= h($user->address) ?></td>
        </tr>
        <tr>
            <th colspan=""2"><h2><?= __('Membership info')?></h2></th>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $user->has('role') ? $this->Html->link($user->role->role_name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <?php if ( count($user->athletes) > 0 ) : ?>
            <tr>
                <th scope="row"><?= __('Associated Athletes') ?></th>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('athletes.id', __('id')) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('athletes.name', __('Name')) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('athletes.surname', __('surname')) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('athletes.asi_subscription_number', __('ASI subscription #')) ?></th>
                                <th scope="col"><?= $this->Paginator->sort('athletes.asi_subscription_date', __('ASI subscription date')) ?></th>
                            </tr>
                        </thead>
                        <?php foreach ($user->athletes as $athlete) : ?>
                            <tr>
                                <td><?= h($athlete['id']) ?></td>
                                <td><?= h($athlete['name']) ?></td>
                                <td><?= h($athlete['surname']) ?></td>
                                <td><?= h($athlete['asi_subscription_number']) ?></td>
                                <td><?= h($athlete['asi_subscription_date']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
        <?php endif; ?>   
    </table>
</div>
