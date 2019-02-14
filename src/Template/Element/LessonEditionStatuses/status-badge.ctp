<?php

Use Cake\Core\Configure;

$status = array_search($statusId, Configure::read('lesson_edition_statuses'));
?>

<span class="badge lesson-edition-<?= $status ?>"><?= $status ?></span>
