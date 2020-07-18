<?php
use Cake\I18n\Time;
$now = New Time();

?>
<div class="content">
	<?= $this->Form->create($course_session) ?>
	<?= $this->Form->date('event.start_date', ['value' => $now]); ?>
	<?= $this->Form->hour('event.start_date'); ?>
	<?= $this->Form->minute('event.start_date'); ?>
	<?= $this->Form->control('course_id', ['type' => 'hidden', 'value' => $course->id])?>
	<?= $this->Form->submit(__('Aggiungi Sessione al Corso {0} - {1}', [h($course->name), h($course->course_level->name)]))?>
	<?= $this->Form->end() ?>
</div>