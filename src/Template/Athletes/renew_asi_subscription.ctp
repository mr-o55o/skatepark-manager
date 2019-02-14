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
    <fieldset>
        <legend><?= __('Edit Athlete') ?></legend>
        <?php
            echo $this->Form->control('asi_subscription_number');
            echo $this->Form->control('asi_subscription_date', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
