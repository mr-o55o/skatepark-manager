<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete[]|\Cake\Collection\CollectionInterface $athletes
 */

use Cake\I18n\Time;
?>
<div class="athletes index content">
    <h3>
      <?= __('Athletes with expired ASI Subscription') ?>
    </h3>  

    <div class="text-right">
      <?= $this->Html->Link( __('Sign Up a new Athlete'), ['action' => 'add'], ['class' => ['btn', 'btn-info', 'text-white']]); ?>
      <?= $this->Html->Link( __('Search for an Athlete'), ['action' => 'search'], ['class' => ['btn', 'btn-info', 'text-white']]); ?>
    </div>
    <hr>
    <?php if (count($athletes) > 0) : ?>
    <table  class="table table-striped table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asi_subscription_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asi_subscription_date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($athletes as $athlete): ?>

            <?php
            $subscriptionExpired = false;
            if ($athlete->asi_subscription_date->modify('+1 Year') < Time::now()) {
                $subscriptionExpired = true;
            }
            ?>

            <tr>
                <td><?= $this->Number->format($athlete->id) ?></td>
                <td><?= h($athlete->name) ?></td>
                <td><?= h($athlete->surname) ?></td>
                <td><?= h($athlete->birthdate) ?></td>
                <td><?= $athlete->has('user') ? $this->Html->link($athlete->user->name, ['controller' => 'Users', 'action' => 'view', $athlete->user->id]) : '' ?></td>
                <td><?= h($athlete->asi_subscription_number) ?></td>
                <td class="<?= ($subscriptionExpired) ? 'text-danger' : '' ?>"><?= h($athlete->asi_subscription_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $athlete->id], ['class' => ['btn', 'btn-info']]) ?> 
                    <?php if ( !$subscriptionExpired ) : ?>
                        <?= $this->Html->Link(_('Book a Lesson'), ['controller' => 'LessonEditions', 'action' => 'add', $athlete->id], ['class' => ['btn', 'btn-info']]) ?>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator text-center">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <?php else : ?>
        <div class="alert alert-info"><?= __('No Athletes with an expired subscription.') ?></div>
    <?php endif ?>
</div>
