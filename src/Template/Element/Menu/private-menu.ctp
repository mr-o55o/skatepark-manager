<?php

?>
<ul class="list-unstyled">
	<li class="heading"><?= __('Logged in as')?> <?= $loggedUser['username'] ?></li>
	<li><?=$this->Html->Link('Logout', ['controller' => 'Users', 'action' => 'logout']) ?></li>
</ul>
