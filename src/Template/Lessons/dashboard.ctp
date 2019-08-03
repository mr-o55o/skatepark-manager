<?php

?>

<?php foreach ($lessonsCount as $lesson) : ?>
	<p><?= $lesson->name ?>: <?= $lesson->editions_count ?></p>
<?php endforeach; ?>

<?php foreach ($lessonsEditionsByStatus as $lesson) : ?>
	<p><?= $lesson->name ?> (<?= $lesson->status ?>): <?= $lesson->number_booked ?> - <?= $lesson->number_completed ?></p>
<?php endforeach; ?>