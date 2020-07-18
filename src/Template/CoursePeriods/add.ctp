<?php

?>

<div class="course-period content">
	<?= $this->Form->create($coursePeriod); ?>
		<?= $this->Form->control('name') ?>
		<?= $this->Form->control('start_date') ?>
		<?= $this->Form->control('end_date') ?>
		<?= $this->Form->submit('Salva') ?>


	<?= $this->Form->end() ?>
</div>