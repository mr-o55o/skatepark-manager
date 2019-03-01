<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEditionsBundle[]|\Cake\Collection\CollectionInterface $lessonEditionsBundles
 */
?>
<div class="lessonEditionsBundles content">
    <h3>
      <?= __('Lessons Management') ?> - <?= __('Lesson Editions Bundles') ?>
    </h3>
    <small><?= __('Bundles are a certain number of lesson offered at a discounted price.') ?></small>  
    <hr>
    <div class="text-right">
      <?= $this->Html->Link( __('Add a new Bundle'), ['action' => 'add'], ['class' => ['btn', 'btn-primary']]); ?>
    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lesson_edition_count') ?></th>
                <th scope="col"><?= $this->Paginator->sort('duration') ?></th>
                <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                <th scope="col"><?= $this->Paginator->sort('lesson.name') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lessonEditionsBundles as $lessonEditionsBundle): ?>
            <tr>
                <td><?= $this->Number->format($lessonEditionsBundle->id) ?></td>
                <td><?= h($lessonEditionsBundle->name) ?></td>
                <td><?= $this->Number->format($lessonEditionsBundle->lesson_edition_count) ?></td>
                <td><?= $this->Number->format($lessonEditionsBundle->duration) ?></td>
                <td><?= h($lessonEditionsBundle->is_active) ?></td>
                <td><?= $this->Number->format($lessonEditionsBundle->price) ?></td>
                <td><?= __($lessonEditionsBundle->lesson->name) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $lessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lessonEditionsBundle->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lessonEditionsBundle->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonEditionsBundle->id), 'class' => 'btn btn-danger']) ?>
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
