<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
use Cake\I18n\Time;
?>

<div class="activity content">
    <h3>
      <?= __('Programma attività') ?> - <?= __('Step 1') ?>
    </h3>
    <?= $this->Form->create($activity) ?>
    <fieldset>
        <label><?= __('Seleziona il tipo di attività') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
        <?= $this->Form->control('activity_type_id', ['options' => $activity_types, 'label' => false]); ?>
        <hr>
        <label><?= __('Seleziona data e ora di inizio') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
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
        </div>
        <hr>
        <label><?= __('Durata') ?></label>
        <div class="row">
            <div class="col">
                <span><?= __('Inserisci la durata in ore') ?></span>: <?= $this->Form->number('duration', []); ?> 
            </div>
        </div>
        <hr>
        <label><?= __('Titolo evento') ?></label>
        <div class="row">
            <div class="col">
            <span><?= __('Inserisci un titolo se vuoi identificare in modo particolare questa attività, se non specificato viene usato il nome attività.') ?></span> <?= $this->Form->input('event.title') ?>
            </div>
        </div>
        <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Required field') ?></p>
    </fieldset>
    <?= $this->Form->submit(__(_('Proceed to user selection'))); ?>
    <?= $this->Form->end() ?>
</div>