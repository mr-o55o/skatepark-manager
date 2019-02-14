<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson[]|\Cake\Collection\CollectionInterface $lessons
 */
?>
<div class="lessons index content">
     <h3>
      <?= __('Lessons Management') ?> - <?= __('Lessons') ?>
    </h3>
    <small><?= __('A lesson is characterized by a name, an optional description, a duration in minutes, a unit price, etc; lessons cannot be modified if they are already associated to any lesson edition') ?></small>    
    <hr>
    <div class="text-right">
      <?= $this->Html->Link( __('Add a new Lesson'), ['action' => 'add'], ['class' => ['btn', 'btn-primary']]); ?>
    </div>
    <hr>
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
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                <tr>
                    <td><?= $this->Number->format($lesson->id) ?></td>
                    <td><?= $lesson->name ?></td>
                    <td><?= h($lesson->description) ?></td>
                    <td><?= $this->Number->format($lesson->duration) ?></td>
                    <td><?= $this->Number->currency($lesson->price, 'EUR'); ?></td>
                    <td><?= $this->Number->currency($lesson->trainer_fee, 'EUR'); ?></td>
                    <td><?= $lesson->is_active ?></td>
                    <td>
                    	<?= $this->Html->link(__('View'), ['action' => 'view', $lesson->id], ['class' => 'btn btn-primary']) ?>
                    	<?php if (count($lesson->lesson_editions) == 0) : ?>
                    		<?= $this->Html->link(__('Edit'), ['action' => 'edit', $lesson->id], ['class' => 'btn btn-primary']) ?>
                    		<?= $this->Form->postLink('Delete', [ 'action' => 'delete', $lesson->id], ['confirm' => __('Deleting Lesson with id {0} are you sure?', $lesson->id), 'class' => 'btn btn-danger']); ?>
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
    <?php else : ?>
        <div class="alert alert-info"><?= __('No lesson editions found :(') ?></div>
    <?php endif ?>
</div>
