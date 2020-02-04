<?php

Use Cake\Core\Configure;

$status = array_search($statusId, Configure::read('course_session_statuses'));
?>

<span class="badge course-session-<?= $status ?>"><?= $status ?></span>
