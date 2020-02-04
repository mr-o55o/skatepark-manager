<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete[]|\Cake\Collection\CollectionInterface $athletes
 */

use Cake\I18n\Time;
?>
<div class="athletes index content">
    <?= $this->Element('Athletes/page-header-index') ?>
    
    <?= $this->Element('Athletes/filter-form'); ?>

    <?php if (count($athletes) > 0) : ?>
        <table  class="table table-striped table-condensed">
        <thead class="thead">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= __('Nome e Cognome') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate', ['label' => __('Data di nascita (età)')]) ?></th>
                <th scope="col"><?= __('Codice Fiscale') ?></th>
                <th scope="col"><?= __('Iscrizione ASI') ?></th>
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
                    <td class="text-center"><?= $this->Html->link($athlete->id, ['action' => 'view', $athlete->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                    <td><?= h($athlete->name) ?> <?= h($athlete->surname) ?></td>
                    <td><?= $athlete->birthdate->i18nFormat('dd/MM/YYYY'); ?> (<?=$athlete->birthdate->diffInYears(Time::now())?>)</td>
                    <td><?= h($athlete->fiscal_code) ?></td>
                    <td class="<?= ($subscriptionExpired) ? 'text-danger' : '' ?>">#<?= h($athlete->asi_subscription_number) ?> <?= h($athlete->asi_subscription_date) ?></td>
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
        <div class="alert alert-warning"><?= __('No Athletes with an active subscription.') ?></div>
    <?php endif ?>
</div>
