<?php 

?>


 <ul class="nav justify-content-center">
  <li class="nav-item">
    <?= $this->Html->Link( __('Create a new Lesson Edition'), ['action' => 'add'], ['class' => 'nav-link']); ?>
  </li>
  <li class="nav-item">
    <?= $this->Html->Link( __('Search for an existing Lesson Edition'), ['action' => 'search'], ['class' => 'nav-link']); ?>
  </li>
</ul>