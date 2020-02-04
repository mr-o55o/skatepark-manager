<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */
?>
<div class="athletes content">
    <?= $this->Form->create($athlete) ?>
    <?= $athlete->name ?> <?= $athlete->surname ?>
    <?= $athlete->asi_subscription_date ?>
    <h3><?= __('Iscrizione ASI') ?></h3>
    <p><?= __('L\'iscrizione ASI è annuale') ?></p>
    <div class="row">
        <div class="col"><?= $this->Form->control('asi_subscription_number'); ?></div>
        <div class="col"><?= $this->Form->control('asi_subscription_date', ['empty' => true]);?></div>
    </div>
    <hr>
    <h3><?= __('Iscrizione FISR') ?></h3>
    <p><?= __('L\'iscrizione FISR segue la stagione sportiva che inizia il primo ottobre ogni anno') ?></p>
    <div class="row">
        <div class="col">
            <?= $this->Form->checkbox('fisr_subscription') ?>
        </div>
    </div>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
