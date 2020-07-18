<?php
use Cake\Core\Configure;
?>
<div class="content">
 <h4><?= __('Crezione Classi per il Periodo') ?>: <span class="text-success"><?= h($activeCoursePeriod->name) ?></span></h4>

 <p><strong><?= __('Abbonamenti Validi da distribuire: ') ?> <?= count($courseSubscriptions) ?></strong></p>
 <p><?= __('Saranno create le seguenti Classi') ?>:</p>

 <table class="table table-condensed table-striped">
 	<thead>
	 	<tr>
	 		<th scope="col"><?= __('Classe') ?></th>
	 		<th scope="col"><?= __('# Componenti') ?></th>
	 	</tr>
	 </thead>
	 <tbody>
	 <?php foreach($classes as $class) : ?>
	 	<tr>
	 		<td><?= h($class['name']) ?></td>
	 		<td></td>
	 	</tr>
	 <?php endforeach; ?>
	 </tbody>
 </table>
<hr>
<?= $this->Form->postLink(__('Crea Classi'),[],['class' => 'btn btn-primary btn-sm', 'confirm' => __('Procedere con la crazioni delle classi?') ]) ?>
</div>
