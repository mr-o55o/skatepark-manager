<?php

?>

<?= $this->Form->create('athlete'); ?>
	<h2>Step 3: Select Athlete</h2>
	<?php if($selectedLesson) : ?>
		<h3><?= __('Selected Lesson Type') ?></h3>
			<h4><?= h($selectedLesson->name) ?></h4>
			<ul>
				<li><?= __('Price') ?>: <?= $selectedLesson->price ?></li>
				<li><?= __('Duration') ?>: <?= $selectedLesson->duration ?> <?= __('minutes') ?></li>
			</ul>
	<?php endif; ?>
    <hr>
	<div class="submit">
		
		<?= $this->Form->submit('Continue', ['div' => false]); ?>
		<?= $this->Form->submit('Cancel', ['name' => 'Cancel', 'div' => false]); ?>
	</div>
<?= $this->Form->end() ?>

