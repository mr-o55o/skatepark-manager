<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson $responsiblePerson
 */
?>
<div class="responsiblePersons content">
    <h3>
      <?= __('Athletes Management') ?> - <?= __('View Responsible Person') ?>
    </h3>
    <small><?= __('View responsible person details and related athletes') ?></small>  
    <hr>
     <div class="text-right">
      <?= $this->Html->Link( __('Edit responsible person'), ['action' => 'edit', $responsiblePerson->id], ['class' => ['btn', 'btn-primary']]); ?>

    </div>   
    <hr>    
    <table class="table">
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($responsiblePerson->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Surname') ?></th>
            <td><?= h($responsiblePerson->surname) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($responsiblePerson->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Phone') ?></th>
            <td><?= h($responsiblePerson->phone) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Fiscal Code') ?></th>
            <td><?= h($responsiblePerson->fiscal_code) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($responsiblePerson->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Athletes') ?></h4>
        <?php if (!empty($responsiblePerson->athletes)): ?>
        <table  class="table table-striped">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Name') ?></th>
                <th scope="col"><?= __('Surname') ?></th>
                <th scope="col"><?= __('Birthdate') ?></th>
                <th scope="col"><?= __('Asi Subscription Date') ?></th>
                <th scope="col"><?= __('Asi Subscription Number') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($responsiblePerson->athletes as $athletes): ?>
            <tr>
                <td><?= h($athletes->id) ?></td>
                <td><?= h($athletes->name) ?></td>
                <td><?= h($athletes->surname) ?></td>
                <td><?= h($athletes->birthdate) ?></td>
                <td><?= h($athletes->asi_subscription_date) ?></td>
                <td><?= h($athletes->asi_subscription_number) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Athletes', 'action' => 'view', $athletes->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Athletes', 'action' => 'edit', $athletes->id], ['class' => 'btn btn-primary']) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
