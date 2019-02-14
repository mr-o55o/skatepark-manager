<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
?>
<div class=" content">
    <h3>
      <?= __('Lessons Management') ?> - <?= __('Cancel lesson edition') ?>
    </h3>
    <small><?= __('...') ?></small>  
    <div class="text-right">
      <?= $this->Html->Link( __('View'), ['action' => 'view', $lessonEdition->id], ['class' => ['btn', 'btn-primary']]); ?>
    </div>
    <hr>

    <h4><?= __('Lesson Edition details') ?></h4>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Lesson') ?></th>
            <td><?= $lessonEdition->has('lesson') ? $this->Html->link($lessonEdition->lesson->name, ['controller' => 'Lessons', 'action' => 'view', $lessonEdition->lesson->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Lesson Status') ?></th>
            <td><?= $lessonEdition->has('lesson_edition_status') ? $this->Html->link($lessonEdition->lesson_edition_status->name, ['controller' => 'LessonStatuses', 'action' => 'view', $lessonEdition->lesson_edition_status->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Athlete') ?></th>
            <td><?= $lessonEdition->has('athlete') ? $this->Html->link($lessonEdition->athlete->name, ['controller' => 'Athletes', 'action' => 'view', $lessonEdition->athlete->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Trainer') ?></th>
            <td><?= $lessonEdition->has('user') ? $this->Html->link($lessonEdition->user->name, ['controller' => 'Users', 'action' => 'view', $lessonEdition->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($lessonEdition->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($lessonEdition->modified) ?></td>
        </tr>
    </table>
    
    <?= $this->Form->create($lessonEdition) ?>
    <fieldset>
        <label><?= __('Notes') ?></label>
        <?= $this->Form->textarea('notes') ;?>
        <?= $this->Form->radio('setStatus', ['Cancelled dy Athlete','Cancelled by Staff']) ;?>
    </fieldset>
    <?= $this->Form->button(__('Cancel booked edition'), ['class' => 'btn-warning']) ?>
    <?= $this->Form->end() ?>    
</div>
