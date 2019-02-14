<?php

?>

<?= $this->Form->create('event'); ?>
	<h2>Step 2: Select Event Time</h2>
	<?php if(isset($selectedLesson)) : ?>
		<h3><?= __('Selected Lesson Type') ?></h3>
			<h4><?= h($selectedLesson->name) ?></h4>
			<ul>
				<li><?= __('Price') ?>: <?= $selectedLesson->price ?></li>
				<li><?= __('Duration') ?>: <?= $selectedLesson->duration ?> <?= __('minutes') ?></li>
			</ul>
	<?php endif; ?>
	<div class="submit">
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
		<?= $this->Form->submit('Continue', array('div' => false)); ?>
		<?= $this->Form->submit('Cancel', array('name' => 'Cancel', 'div' => false)); ?>
	</div>
<?= $this->Form->end() ?>

