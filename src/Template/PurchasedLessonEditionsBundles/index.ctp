<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\PurchasedLessonEditionsBundle[]|\Cake\Collection\CollectionInterface $purchasedLessonEditionsBundles
 */
?>
<div class="purchasedLessonEditionsBundles content">
    <h3><?= __('Purchased Lesson Editions Bundles') ?></h3>
    <small>...</small>
    <hr>
    <?php
        echo $this->Form->create(null, ['valueSources' => 'query', 'type' => 'get']);
        // Match the search param in your table configuration
        echo $this->Form->control('q', ['label' => __('Search text in Athlete name and surname fields')]);
        echo $this->Form->button('Filter', ['type' => 'submit']);
        echo $this->Html->link('Reset', ['action' => 'index']);
        echo $this->Form->end();
    ?>
    <hr>
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
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($purchasedLessonEditionsBundles as $purchasedLessonEditionsBundle): ?>
            <tr>
                <td><?= $this->Number->format($purchasedLessonEditionsBundle->id) ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('athlete') ? $this->Html->link($purchasedLessonEditionsBundle->athlete->name . ' ' . $purchasedLessonEditionsBundle->athlete->surname, ['controller' => 'Athletes', 'action' => 'view', $purchasedLessonEditionsBundle->athlete->id]) : '' ?></td>
                <td><?= $purchasedLessonEditionsBundle->has('lesson_editions_bundle') ? $this->Html->link($purchasedLessonEditionsBundle->lesson_editions_bundle->name, ['controller' => 'LessonEditionsBundles', 'action' => 'view', $purchasedLessonEditionsBundle->lesson_editions_bundle->id]) : '' ?></td>
                <td><?= $this->element('PurchasedLessonEditionsBundleStatuses/status-badge', ['statusId' => $purchasedLessonEditionsBundle->status]); ?></td>
                <td><?= h($purchasedLessonEditionsBundle->start_date) ?></td>
                <td><?= h($purchasedLessonEditionsBundle->end_date) ?></td>
                <td><?= $this->Number->format($purchasedLessonEditionsBundle->count) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $purchasedLessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $purchasedLessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
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
