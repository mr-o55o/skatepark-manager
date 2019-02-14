<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
?>

<div class="lessonEditions content">
    <h3>
      <?= __('Lesson Editions Management') ?> - <?= __('Add a lesson edition') ?>
    </h3>
    <?= $this->Form->create($lesson_edition) ?>
    <fieldset>
        <?= $this->Form->control('lesson_id', ['options' => $lessons, 'label' => __('Select type of lesson')]); ?>
        <hr>
        <label><?= __('Select lesson edition start date and time') ?></label>
        <div class="row">
            <div class="col">
                <span><?= __('Year') ?></span>: <?= $this->Form->year('event.start_date', [
                    'minYear' => date('Y'),
                ]) ;?>
            </div>
            <div class="col">
                 <span><?= __('Month') ?></span>: <?= $this->Form->month('event.start_date', [
                ]) ;?>               
            </div>
            <div class="col">
                <span><?= __('Day') ?></span>: <?= $this->Form->day('event.start_date', [
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
    </fieldset>
    <?= $this->Form->submit(__(_('Proceed to trainer and athlete selection'))); ?>
    <?= $this->Form->end() ?>
</div>


