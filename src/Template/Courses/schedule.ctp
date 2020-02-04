<?php

?>


<?php if (count($course->course_sessions) > 0) : ?>
<h3><?= __('Il corso prevede le seguenti sessioni:') ?></h3>

<table class="table table-condensed">
	<thead>
		<tr>
			<th scope="col"><?= __('Id') ?></th>
			<th scope="col"><?= __('Data e orario') ?></th>
		</tr>
	</thead>

	<tbody>
	<?php foreach($course->course_sessions as $session) : ?>
		<tr>
			<td><?= $session->id ?></td>
			<td><?= $session->event->start_date->i18nFormat('dd/MM/YYYY')?> <?= __('dalle')?> <?=$session->event->start_date->i18nFormat('HH:mm')?> <?= __('alle')?> <<?=$session->event->end_date->i18nFormat('HH:mm')?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>

<?php endif ?>