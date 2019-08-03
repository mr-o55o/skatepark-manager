<?php

Use Cake\Core\Configure;

$status = array_search($statusId, Configure::read('activity_statuses'));
?>

<span class="badge activity-status-<?= $status ?>"><?= $status ?></span>
