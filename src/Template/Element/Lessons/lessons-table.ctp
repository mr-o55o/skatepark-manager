<?php
Use Cake\Core\Configure;
?>


    <?php if (count($lessons) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                    <th scope="col"><?= __('Description')?></th>
                    <th scope="col"><?= $this->Paginator->sort('duration') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('price') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('trainer_fee') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('is_active') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= $this->Number->format($lesson->id) ?></td>
                    <td><?= $this->Html->link($lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lesson->id])?></td>
                    <td><?= h($lesson->description) ?></td>
                    <td><?= $this->Number->format($lesson->duration) ?></td>
                    <td><?= $this->Number->currency($lesson->price, 'EUR'); ?></td>
                    <td><?= $this->Number->currency($lesson->trainer_fee, 'EUR'); ?></td>
                    <td><?= $lesson->is_active ?></td>
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