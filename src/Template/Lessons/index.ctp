<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson[]|\Cake\Collection\CollectionInterface $lessons
 */
?>
<div class="lessons index content">

    <?php if (count($lessons) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= __('Nome') ?></th>
                    <th scope="col"><?= __('Description')?></th>
                    <th scope="col"><?= __('Durata (minuti)') ?></th>
                    <th scope="col"><?= __('Iscrizione ASI richiesta') ?></th>
                    <th scope="col"><?= __('Prezzo') ?></th>
                    <th scope="col"><?= __('Quota istruttore') ?></th>
                    <th scope="col"><?= __('Attiva') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= $this->Html->link($this->Number->format($lesson->id), ['action' => 'view', $lesson->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                    <td><?= $lesson->name ?></td>
                    <td><?= h($lesson->description) ?></td>
                    <td><?= $this->Number->format($lesson->duration) ?></td>
                    <td><?= $lesson->is_asi_subscription_required ? __('Sì') : __('No') ?></td>
                    <td><?= $this->Number->currency($lesson->price, 'EUR'); ?></td>
                    <td><?= $this->Number->currency($lesson->trainer_fee, 'EUR'); ?></td>
                    <td><?= $lesson->is_active ? __('Sì') : __('No') ?></td>
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
