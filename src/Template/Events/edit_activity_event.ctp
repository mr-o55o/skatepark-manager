<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?php echo $this->element('Errors/error-box') ?>

<div class="content">
    <h3>
      <?= __('Event Management') ?> - <?= __('Edit Activity Event') ?>
    </h3>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Fill the form to edit this Activity Event') ?></legend>
        <?= $this->Form->control('activity.activity_type_id', ['options' => $activity_types, 'label' => __('Lesson type') ]); ?>
        <hr>
        <label><?= __('Date and time') ?></label>
        <div class="row">
            <div class="col">
                <span><?= __('Year') ?></span>: <?= $this->Form->year('start_date', ['minYear' => date('Y')]) ;?>
            </div>
            <div class="col">
                 <span><?= __('Month') ?></span>: <?= $this->Form->month('start_date') ;?>               
            </div>
            <div class="col">
                <span><?= __('Day') ?></span>: <?= $this->Form->day('start_date') ;?>               
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span><?= __('Hours') ?></span>: <?= $this->Form->hour('start_date'); ?>
            </div>
            <div class="col">
                <span><?= __('Minutes') ?></span>: <?= $this->Form->minute('start_date', ['interval' => 15]); ?>
            </div>
            <div class="col">

            </div>
        </div>
        <hr>
        <?php echo $this->element('Users/ajax-search-field', ['label' => 'Trainer', 'selectedUser' => (isset($event->activity->user) ? $event->activity->user->username : 'None'), 'event' => 'activity', 'role' => 'staffmembers']); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
