<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle[]|\Cake\Collection\CollectionInterface $purchasedLessonEditionsBundles
 */

use Cake\I18n\Time;
?>
<div class="purchasedLessonEditionsBundles content">
    <?= $this->Element('PurchasedLessonEditionsBundles/page-header') ?>
    <?= $this->Element('Athletes/filter-form') ?> 
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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasedLessonEditionsBundles as $purchasedLessonEditionsBundle): ?>
            <tr>
                <td><?= $this->Html->link($purchasedLessonEditionsBundle->id, ['action' => 'view', $purchasedLessonEditionsBundle->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('athlete') ? $this->Html->link($purchasedLessonEditionsBundle->athlete->name . ' ' . $purchasedLessonEditionsBundle->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $purchasedLessonEditionsBundle->athlete->id]) : '' ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('lesson_editions_bundle') ? $this->Html->link($purchasedLessonEditionsBundle->lesson_editions_bundle->name, ['controller' => 'LessonEditionsBundles', 'action' => 'view', $purchasedLessonEditionsBundle->lesson_editions_bundle->id]) : '' ?></td>
                <td><?= $this->element('PurchasedLessonEditionsBundleStatuses/status-badge', ['statusId' => $purchasedLessonEditionsBundle->status]); ?></td>
                <td><?= h($purchasedLessonEditionsBundle->start_date) ?></td>
                <td><?= h($purchasedLessonEditionsBundle->end_date) ?></td>
                <td><?= $this->Number->format($purchasedLessonEditionsBundle->count) ?></td>
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
