<?php

?>
<ul>
  <li><?= $this->Html->link(__('Manage Users'), ['controller' => 'Users', 'action' => 'index' ]) ?></li>
  <li><?= $this->Html->link(__('Manage Lesson Types'), ['controller' => 'Lessons', 'action' => 'index' ]) ?></li>
  <li><?= $this->Html->link(__('Manage Lesson Editions Bundles'), ['controller' => 'LessonsEditionsBundles', 'action' => 'index' ]) ?></li>
</ul>