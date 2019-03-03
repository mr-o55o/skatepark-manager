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
        <label><?= __('Select new bundle end time') ?></label>
        <div class="row">
            <div class="col">
                <span><?= __('Year') ?></span>: <?= $this->Form->year('end_date', [
                    'value' => Time::now(),
                    'minYear' => date('Y'),
                ]) ;?>
            </div>
            <div class="col">
                 <span><?= __('Month') ?></span>: <?= $this->Form->month('end_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
            <div class="col">
                <span><?= __('Day') ?></span>: <?= $this->Form->day('end_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
        </div>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>