<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>

<div class="lessons content">
    <h3>
      <?= __('Lessons Management') ?> - <?= __('Edit Lesson') ?>
    </h3>
    <small><?= __('A lesson is characterized by a name, an optional description, a duration in minutes, a unit price, etc; lessons cannot be modified if they are already associated to any lesson edition') ?></small>    
    <hr>
        <div class="text-right">
            <?= $this->Html->Link( __('Lessons Index'), ['action' => 'index'], ['class' => ['btn', 'btn-primary']]); ?>
        </div>
    <hr>
    <?= $this->Form->create($lesson) ?>
    <fieldset>
        <?= $this->Form->control('name', ['label' => __('Name')]); ?>
        <label><?= __('Description') ?></label>
        <?= $this->Form->textArea('description'); ?>
        <?= $this->Form->control('is_active', ['label' => _('Active')])?>
        <?= $this->Form->control('duration', ['label' => _('Duration')])?>
        <?= $this->Form->control('price', ['label' => _('Price')])?>
        <?= $this->Form->control('trainer_fee', ['label' => _('Trainer Fee')])?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
