<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Lesson $lesson
 */
?>

<div class="lessons content">
    <h4><?= __('Add New Lesson') ?></h4>
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
