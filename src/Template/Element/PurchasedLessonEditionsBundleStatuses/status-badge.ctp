<?php

Use Cake\Core\Configure;

$status = array_search($statusId, Configure::read('purchased_lesson_editions_bundle_statuses'));
?>

<span class="badge lesson-edition-<?= $status ?>"><?= $status ?></span>
