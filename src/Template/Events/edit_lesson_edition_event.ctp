<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?php echo $this->element('Errors/error-box') ?>

<div class="content">
    <h3>
      <?= __('Event Management') ?> - <?= __('Edit lesson edition') ?>
    </h3>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <legend><?= __('Fill the form to add a Lesson Edition and the associated event') ?></legend>
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
        <?= $this->Form->control('lesson_edition.lesson_id', ['options' => $lessons, 'label' => __('Lesson type') ]); ?>
        <hr>
        <?php echo $this->element('Athletes/ajax-search-field', ['label' => 'Athlete', 'selectedAthlete' => (isset($event->lesson_edition->athlete) ? $event->lesson_edition->athlete->name.' '.$event->lesson_edition->athlete->surname : 'None'), 'event' => 'lesson_edition']); ?>
        <hr>
        <?php echo $this->element('Users/ajax-search-field', ['label' => 'Trainer', 'selectedUser' => (isset($event->lesson_edition->user) ? $event->lesson_edition->user->username : 'None'), 'event' => 'lesson_edition', 'role' => 'trainers']); ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
