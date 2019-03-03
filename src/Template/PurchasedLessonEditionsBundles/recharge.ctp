<?php
use Cake\I18n\Time;
?>
<?php if (isset($errors)) : ?>
    <h3 class="text-danger"><?= __('Errors detected during add operation:') ?></h3>
    <ul>
    <?php foreach($errors as $field): ?>
        <?php foreach($field as $error): ?>
            <li><?=$error?></li>
        <?php endforeach ?>
    <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="purchasedLessonEditionsBundles content">
    <?= $this->Form->create($purchasedLessonEditionsBundle) ?>
    <fieldset>
        <legend><?= __('Extend Bundle') ?></legend>
        <label><?= __('Select number of charges') ?></label>
        <?= $this->Form->control('count')?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>