<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?php echo $this->element('Errors/error-box') ?>

<div class="content">
    <h3>
      <?= __('Event Management') ?> - <?= __('Add an Activity Event') ?>
    </h3>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Fill the form to add an Activity Event') ?></legend>
        <?= $this->Form->control('activity.activity_type_id', ['options' => $activity_types, 'label' => __('Activity type') ]); ?>
        <hr>
        <label><?= __('Activity starts at') ?></label>
        <div class="row">
            <div class="col">
                <span><?= __('Year') ?></span>: <?= $this->Form->year('start_date', [
                    'minYear' => date('Y'),
                ]) ;?>
            </div>
            <div class="col">
                 <span><?= __('Month') ?></span>: <?= $this->Form->month('start_date', [
                ]) ;?>               
            </div>
            <div class="col">
                <span><?= __('Day') ?></span>: <?= $this->Form->day('start_date', [
                ]) ;?>               
            </div>
        </div>
        <div class="row">
            <div class="col">
                <span><?= __('Hours') ?></span>: <?= $this->Form->hour('start_date', []); ?>
            </div>
            <div class="col">
                <span><?= __('Minutes') ?></span>: <?= $this->Form->minute('start_date', [
                    'interval' => 15,
                ]); ?>
            </div>
            <div class="col">

            </div>
        </div>
        <hr>
        <label><?= __('Activity duration (hours)') ?></label>
        <?= $this->Form->text('duration') ?>
        <hr>
        <?php echo $this->element('Users/ajax-search-field', ['label' => 'Staff Member', 'selectedUser' => (isset($event->lesson_edition->user) ? $event->lesson_edition->user->username : 'None'), 'event' => 'activity', 'role' => 'staffmembers']); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
