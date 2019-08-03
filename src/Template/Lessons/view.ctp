<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>
<div class="lessons content">
    <h4>
      <?= __('View Lesson') ?>
    </h4>
    <div class="text-right">
        <?php if ($countLessonEditions == 0) : ?>
            <?= $this->Html->Link( __('Edit'), ['action' => 'edit', $lesson->id], ['class' => ['btn', 'btn-primary']]); ?>
        <?php endif; ?>

        <?php if ($lesson->is_active) :?>
            <?= $this->Html->Link( __('Deactivate'), ['action' => 'deactivate', $lesson->id], ['class' => ['btn', 'btn-primary']]); ?>
        <?php endif; ?>

        <?php if (!$lesson->is_active) :?>
            <?= $this->Html->Link( __('Activate'), ['action' => 'activate', $lesson->id], ['class' => ['btn', 'btn-primary']]); ?>
        <?php endif; ?> 
    </div>
    <hr>
    <table class="table table-striped table-condensed">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($lesson->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Name') ?></th>
            <td><?= h($lesson->name) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($lesson->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Duration (minutes)') ?></th>
            <td><?= $lesson->duration ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Active') ?></th>
            <td><?= $lesson->is_active ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($lesson->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($lesson->modified) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Count of Lesson Editions') ?></th>
            <td><?= $this->Number->format($countLessonEditions) ?></td>
        </tr>
    </table>
    <?= $this->Html->link(__('Back'), $back_url) ?>
</div>
