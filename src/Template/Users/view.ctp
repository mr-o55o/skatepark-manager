<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
use Cake\Core\Configure;
?>
<div class="users view content">
    <div class="container">
        <div class="row">
            <div class="col"><h4><?= __('View user details for')?> <?=h($user->username) ?></h4></div>
            <div class="col">
                <?php if ($loggedUser['role'] == 'Admin') : ?>
                    <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'btn btn-primary']); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <hr>
    <h5><?= __('Anagraphical info')?></h5>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($user->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Birth Date') ?></th>
            <td><?= $user->birthdate->i18nFormat('dd/MM/YYYY') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fiscal Code') ?></th>
            <td><?= h($user->fiscal_code) ?></td>
        </tr>
    </table>
    <hr>
    <h5><?= __('Contacts')?></h5>
    <table class="table table-striped">
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
    </table>
    <hr>
    <h5><?= __('Membership info')?></h5>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Role') ?></th>
            <td><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '--' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $user->active ? __('Yes') : __('No'); ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr> 
    </table>
    <hr>
    <?php if ($user->role_id == Configure::read('roles')['trainer']) : ?>
        <?php if ($user->has('booked_lesson_editions')) : ?>
            <h4><?= __('Booked Lesson Editions for this trainer') ?></h4>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th><?= __('Lesson Type') ?></th>
                        <th><?= __('Date') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($user->booked_lesson_editions as $booked_edition) : ?>
                    <tr>
                        <td><?= $booked_edition->lesson->name ?></td>
                        <td><?=$booked_edition->event->start_date->i18nFormat('EEEE d MMMM YYYY @ HH:mm') ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    <?php endif; ?>
</div>
