<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
use Cake\I18n\Time;
?>

<div class="lessonEditions content">
    <?= $this->Element('LessonEditions/page-header') ?>
    <?= $this->Form->create($lesson_edition) ?>
    <fieldset>
        <label><?= __('Select type of lesson') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
        <?= $this->Form->control('lesson_id', ['options' => $lessons, 'label' => false]); ?>
        <hr>
        <label><?= __('Select lesson edition start date and time') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
        <div class="row">
            <div class="col">
                <span><?= __('Year') ?></span>: <?= $this->Form->year('event.start_date', [
                    'value' => Time::now(),
                    'minYear' => date('Y'),
                ]) ;?>
            </div>
            <div class="col">
                 <span><?= __('Month') ?></span>: <?= $this->Form->month('event.start_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
            <div class="col">
                <span><?= __('Day') ?></span>: <?= $this->Form->day('event.start_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span><?= __('Hours') ?></span>: <?= $this->Form->hour('event.start_date', []); ?>
            </div>
            <div class="col">
                <span><?= __('Minutes') ?></span>: <?= $this->Form->minute('event.start_date', [
                    'interval' => 15,
                ]); ?>
            </div>
            <div class="col">

            </div>
        </div>
        <hr>
        <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Required field') ?></p>
    </fieldset>
    <?= $this->Form->submit(__(_('Proceed to trainer and athlete selection'))); ?>
    <?= $this->Form->end() ?>
</div>


