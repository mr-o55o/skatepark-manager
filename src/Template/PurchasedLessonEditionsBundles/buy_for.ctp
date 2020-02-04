<?php

?>
<div class="content">
    <!-- Contextual Help -->
    <div class="text-right"><?= $this->Element('PurchasedLessonEditionsBundles/modal-help-buyFor') ?></div>

    <!-- Business Errors Recap-->
    <?= ($purchasedLessonEditionsBundle->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $purchasedLessonEditionsBundle->getErrors() ]) : '' ) ?>
    <hr>
	<?= $this->Form->create($purchasedLessonEditionsBundle) ?>
		
	    <table class="table table-striped table-condensed">
	        <tr>
	            <th scope="row"><?= __('Atleta') ?></th>
	            <td><?= h($athlete->name) . ' ' . h($athlete->surname) ?></td>
	        </tr>
	        <tr>
	            <th scope="row"><?= __('Numero iscrizione ASI') ?></th>
	            <td><?= h($athlete->asi_subscription_number) ?></td>
	        </tr>
	        <?php if ($athlete->asi_subscription_date) : ?>
	        <tr>
	            <th scope="row"><?= $athlete->asi_subscription_date ? __('Asi Subscription Date') : '' ?></th>
	            <td>
	                <?= $athlete->asi_subscription_date ?>
	            </td>
	        </tr>
	        <?php endif; ?>
	    </table>
	    <hr>
	    <h3><?= __('Tipo di pacchetto di lezioni') ?></h3>
	    <div class="row">
	    	<div class="col">
	    		<label><?= __('Selezionare uno dei tipi di pacchetto disponibili') ?></label> <?= $this->Form->control('lesson_editions_bundle_id', ['label' => false, 'options' => $lessonEditionsBundles]); ?>
	    	</div>
	    </div>
	        

	    <?= $this->Form->submit('Salva'); ?>
	<?= $this->Form->end() ?>
	<hr>
	<ul class="nav justify-content-center">
		<li class="nav-item"><?= $this->Html->link('Torna all\'atleta', ['controller' => 'Athletes', 'action' => 'view', $athlete->id], ['class' => 'nav-link'])?></li>
	</ul>
</div>