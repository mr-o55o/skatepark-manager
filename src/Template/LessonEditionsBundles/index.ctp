<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEditionsBundle[]|\Cake\Collection\CollectionInterface $lessonEditionsBundles
 */
?>
<div class="lessonEditionsBundles content">
    <h4><?= __('Index') ?></h4>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lesson_edition_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lesson.name') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessonEditionsBundles as $lessonEditionsBundle): ?>
            <tr>
                <td><?= $this->Number->format($lessonEditionsBundle->id) ?></td>
                <td><?= h($lessonEditionsBundle->name) ?></td>
                <td><?= $this->Number->format($lessonEditionsBundle->lesson_edition_count) ?></td>
                <td><?= h($lessonEditionsBundle->is_active) ?></td>
                <td><?= $this->Number->format($lessonEditionsBundle->price) ?></td>
                <td><?= __($lessonEditionsBundle->lesson->name) ?></td>
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
