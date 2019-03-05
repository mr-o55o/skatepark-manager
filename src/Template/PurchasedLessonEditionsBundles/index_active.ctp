<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle[]|\Cake\Collection\CollectionInterface $purchasedLessonEditionsBundles
 */

use Cake\I18n\Time;
use Cake\Core\Configure;
?>
<div class="purchasedLessonEditionsBundles content">
    <h4><?= __('Active Lesson Editions Bundles') ?></h4>
    <?= $this->Element('Athletes/filter-form') ?> 

    <p>
        <?= __('List of currently purchased and activated bundles (active bundles).') ?>
        <?= __('Bundles that reach their end date, must be expired or extended, in either cases they must be managed.')?>
    </p>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('athlete_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lesson_editions_bundle_id') ?></th>
                <th scope="col"><?=__('status') ?></th>
                <th scope="col"><?= $this->Paginator->sort('start_date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('end_date') ?></th>
                <th scope="col"><?= __('Remaining Lesson Editions') ?></th>
                <th scope="col"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasedLessonEditionsBundles as $purchasedLessonEditionsBundle): ?>
            <tr>
                <td><?= $this->Html->link($purchasedLessonEditionsBundle->id, ['action' => 'view', $purchasedLessonEditionsBundle->id]) ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('athlete') ? $this->Html->link($purchasedLessonEditionsBundle->athlete->name . ' ' . $purchasedLessonEditionsBundle->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $purchasedLessonEditionsBundle->athlete->id]) : '' ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('lesson_editions_bundle') ? $this->Html->link($purchasedLessonEditionsBundle->lesson_editions_bundle->name, ['controller' => 'LessonEditionsBundles', 'action' => 'view', $purchasedLessonEditionsBundle->lesson_editions_bundle->id]) : '' ?></td>
                <td><?= $this->element('PurchasedLessonEditionsBundleStatuses/status-badge', ['statusId' => $purchasedLessonEditionsBundle->status]); ?></td>
                <td><?= h($purchasedLessonEditionsBundle->start_date) ?></td>
                <td><?= h($purchasedLessonEditionsBundle->end_date) ?></td>
                <td><?= $this->Number->format($purchasedLessonEditionsBundle->count) ?></td>
                <td class="actions">
                    <?php if ($purchasedLessonEditionsBundle->end_date < Time::now() && $purchasedLessonEditionsBundle->status == Configure::read('purchased_lesson_editions_bundle_statuses')['activated']) : ?>
                        <?= $this->Html->link(__('Extend'), ['action' => 'extend', $purchasedLessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
                        <?= $this->Form->postLink(__('Expire'), ['action' => 'expire', $purchasedLessonEditionsBundle->id], ['confirm' => __('Are you sure you want to mark bundle # {0} as expired?', $purchasedLessonEditionsBundle->id), 'class' => 'btn btn-danger']) ?>
                    <?php endif; ?>
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
