<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Event $event
 */
?>
<?php echo $this->element('Errors/error-box') ?>

<div class="content">
    <h3>
      <?= __('Event Management') ?> - <?= __('Add a lesson edition') ?>
    </h3>
    <?= $this->Form->create($event) ?>
    <fieldset>
        <label><?= __('Date and time') ?></label>
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
        <?php if (isset($event)) : ?>
            <div class="row">
                <div class="col"><?= $this->Form->control('lesson_edition.lesson_id', ['options' => $lessons, 'label' => __('Lesson type') ]); ?></div>
            </div>
            <div class="row">
                <div class="col"><label><?= __('Trainer')?></label>: <?= (isset($event->lesson_edition->user) ? $event->lesson_edition->user->username : '-') ?></div>
                <div class="col"><?= $this->Html->link(__('Select a Trainer'), ['controller' => 'Users', 'action' => 'selectTrainer']) ?></div>
            </div>
            <div class="row">
                <div class="col"><label><?= __('Athlete')?></label>: <?= (isset($event->lesson_edition->athlete) ? $event->lesson_edition->athlete->name . ' ' . $event->lesson_edition->athlete->surname : '-') ?></div>
                <div class="col"><div class="col"><?= $this->Html->link(__('Select an Athlete'), ['controller' => 'Athletes', 'action' => 'selectAthlete']) ?></div>
            </div>
        <?php endif; ?>
    </fieldset>
    <?= $this->Form->button('Submit') ?>
    <?= $this->Form->end() ?>
</div>
