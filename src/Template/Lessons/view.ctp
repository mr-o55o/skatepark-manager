<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>
<div class="lessons content">
     <h3>
      <?= __('Lessons Management') ?> - <?= __('View Lesson') ?>
    </h3>
    <small><?= __('A lesson is characterized by a name, an optional description, a duration in minutes, a unit price, etc; lessons cannot be modified if they are already associated to any lesson edition') ?></small>    
    <hr>
    <div class="text-right">
      <?= $this->Html->Link( __('Lessons index'), ['action' => 'index'], ['class' => ['btn', 'btn-primary']]); ?>
    </div>
    <hr>
    <table class="table table-condensed">
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
