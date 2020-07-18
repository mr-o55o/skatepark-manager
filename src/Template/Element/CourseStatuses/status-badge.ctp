<?php

Use Cake\Core\Configure;

$status = array_search($statusId, Configure::read('course_statuses'));
?>

<span class="badge course-<?= $status ?>"><?= $status ?></span>
