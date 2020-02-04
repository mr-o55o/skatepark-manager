<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AthletesNote $athletesNote
 */
?>
<div class="athletesNotes content">

    <?= $this->Form->create($athletesNote) ?>
        <?= $this->Form->control('athlete_id', ['options' => $athletes, 'disabled' => ($athlete_selected ? true : false) ]); ?>
        <hr>
        <?= $this->Form->control('note'); ?>
        <hr>
        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    <hr>
	<?php  if(count($athleteNotes) > 0) : ?>
		<h3><?= __('Appunti registrati') ?></h3>
		<table class="table table-condensed">
			<tr>
				<th><?= __('Data') ?></th>
				<th><?= __('Appunto') ?></th>
				<th><?= __('Autore') ?></th>
			</tr>
		<?php  foreach ($athleteNotes as $note) : ?>
			<tr>
				<td><?= $note->created ?></td>
				<td><?= $note->note ?> </td>
				<td><?= $note->user->username ?></td>
			</tr>
		<?php endforeach; ?>
		</table>
	<?php endif; ?>
</div>
