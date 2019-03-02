<?php

?>
<div class="lessonEditions index content">
    <h3>
        <?= __('Lesson Management') ?> - <?= __('All lesson editions bundles purchased by') ?> <?= h($athlete->name) ?> <?= h($athlete->surname) ?> 
    </h3>
    <small><?= __('History of lesson editions bundles purchased by athlete') ?></small>
    <hr>
    <div class="text-right">
    	<?= $this->Html->link(__('View Athlete'), ['controller' => 'Athletes', 'action' => 'view', $athlete->id], ['class' => 'btn btn-primary']) ?>
    </div>
    <hr>
    <?php if (count($purchasedLessonEditionsBundles) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('lesson_editions_bundle_id', __('Bundle')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('start_date', __('Date')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('end_date', __('Date')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('status', __('Status')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($purchasedLessonEditionsBundles as $purchasedBundle): ?>
                <tr>
                    <td><?= $this->Html->link($purchasedBundle->id, ['action' => 'view', $purchasedBundle->id]) ?></td>
                    <td><?= $this->Html->link($purchasedBundle->lesson_editions_bundle->name, ['controller' => 'Lessons', 'action' => 'view', $purchasedBundle->lesson_editions_bundle->id]) ?></td>
                    <td><?= h($purchasedBundle->start_date->i18nFormat("dd/MM/Y H:mm")) ?></td>
                    <td><?= h($purchasedBundle->end_date->i18nFormat("dd/MM/Y H:mm")) ?></td>
                    <td><?= $this->element('PurchasedLessonEditionsBundleStatuses/status-badge', ['statusId' => $purchasedBundle->status]); ?></td>
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
    <?php else : ?>
        <div class="alert alert-info"><?= __('No lesson editions found :(') ?></div>
    <?php endif ?>
</div>