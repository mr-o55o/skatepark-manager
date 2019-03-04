<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete[]|\Cake\Collection\CollectionInterface $athletes
 */

use Cake\I18n\Time;
?>
<div class="athletes index content">
    <h4><?= __('Athletes List') ?></h4>
    <?= $this->Element('Athletes/filter-form') ?>
    <table  class="table table-striped table-condensed">
        <thead class="thead">
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('birthdate') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asi_subscription_number') ?></th>
                <th scope="col"><?= $this->Paginator->sort('asi_subscription_date') ?></th>
                <th scope="col"><?= __('Responbile Person') ?></th>
                <th scope="col" class="actions" style="min-width: 30%;"><?= __('Actions') ?></th>
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
                    <td><?= h($athlete->asi_subscription_number) ?></td>
                    <td class="<?= ($subscriptionExpired) ? 'text-danger' : '' ?>"><?= h($athlete->asi_subscription_date) ?></td>
                    <td><?= $athlete->has('responsible_person') ? $this->Html->link($athlete->responsible_person->name . ' ' . $athlete->responsible_person->surname , ['controller' => 'ResponsiblePersons', 'action' => 'view', $athlete->responsible_person_id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $athlete->id], ['class' => ['btn', 'btn-primary']]) ?> 
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $athlete->id], ['class' => ['btn', 'btn-primary']]) ?>
                        <?php if ($subscriptionExpired) : ?>
                            <?= $this->Html->link(_('Renew ASI Subs.'), ['action' => 'renew_asi_subscription'], ['class' => 'btn btn-primary']) ?>
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
</div>
