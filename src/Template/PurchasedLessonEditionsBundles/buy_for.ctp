<?php

?>
<div class="content">
    <h3><?= __('Lesson Management') ?> - <?= __('Assign Lesson Edition Bundle to Athlete')?></h3>
    <hr>
	<?= $this->Form->create($purchasedLessonEditionsBundle) ?>
		
	    <table class="table">
	        <tr>
	            <th scope="row"><?= __('Athlete') ?></th>
	            <td><?= h($athlete->name) . ' ' . h($athlete->surname) ?></td>
	        </tr>
	        <tr>
	            <th scope="row"><?= __('Asi Subscription Number') ?></th>
	            <td><?= h($athlete->asi_subscription_number) ?></td>
	        </tr>
	        <tr>
	            <th scope="row"><?= __('Asi Subscription Date') ?> (<?= __('Subscription expiring on ') ?> <?=$athlete->asi_subscription_date->modify('+1 Year')?>)</th>
	            <td>
	                <?= $athlete->asi_subscription_date ?>
	            </td>
	        </tr>
	    </table>

	    <fieldset>
	        <?php
	            echo $this->Form->control('lesson_editions_bundle_id', ['options' => $lessonEditionsBundles]);
	            //echo $this->Form->control('is_active');
	            //echo $this->Form->control('start_date');
	            //echo $this->Form->control('end_date');
	        ?>
	    </fieldset>
	    <?= $this->Form->submit('Submit'); ?>
	<?= $this->Form->end() ?>
</div>