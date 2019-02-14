<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEditionsCalculations[]|\Cake\Collection\CollectionInterface $lessonEditionsCalculation
 */
Use Cake\Core\Configure;
?>
<div class="lessonEditionsCalculations index content">
    <h3><?= __('Lesson Editions Accounting') ?> - <?= __('Accounting operations index') ?> 
    	<br><small><?= __('..') ?></small>
    </h3>

    <hr>
    <?php if (count($lessonEditionsCalculations) > 0) : ?>
    <table class="table table-striped">
    	<thead>
    		<th><?= __('Id') ?></th>
    		<th><?= __('Date') ?></th>
    	</thead>
    </table>
	<?php else: ?>
		<div class="alert alert-info"><?= __('No lesson editions calculations found.') ?></div>
	<?php endif; ?>

	<?php if ($editionsReadyForAccounting > 0) : ?>
		<?= __('There are {0} lesson editions ready for accounting', $editionsReadyForAccounting) ?>
		<?= $this->Html->Link('Perform accounting', ['action' => 'calculate'], ['class' => 'btn btn-success']) ?>
	<?php endif; ?>
</div>