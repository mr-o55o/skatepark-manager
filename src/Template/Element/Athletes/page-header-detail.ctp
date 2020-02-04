<?php

?>
    <!-- action-bar -->
	<nav class="nav text-white rounded mb-4 justify-content-center">
		<?php if ($this->request->action == 'edit') : ?>
			<!-- view link -->
			<?= $this->Html->link(__('Visualizza dati atleta'), ['controller' => 'Athletes', 'action' => 'view', $id], ['class' => 'nav-link']) ?>
		<?php endif; ?>

		<?php if ($this->request->action == 'view') : ?>
			<!-- edit link -->
			<?= $this->Html->link(__('Modifica dati atleta'), ['controller' => 'Athletes', 'action' => 'edit', $id], ['class' => 'nav-link']) ?>
		<?php endif; ?>
	</nav>
	<hr>


