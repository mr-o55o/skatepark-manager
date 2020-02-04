<?php
use Cake\I18n\Time;
?>

<div class="wizard content">
<h4><?= __('Come funziona il wizard') ?></h4>
<p>
<?= __('Attraverso questa funzione è possibile creare automaticamente le lezioni individuali all\'interno dell\'orario scelto, per tutti i giorni della settimana presenti nel periodo di tempo selezionati, le lezioni vengono create sulla base della disponibilità di istruttori. Le lezioni sono create in stato di bozza.') ?>
</p>
<hr>



<?php if (isset($wizard_output)) : ?>
	<div class="alert alert-info">
		<?= Time::now()->i18nFormat('dd/MM/YYYY HH:mm') ?>: 
		<?= __('Wizard eseguito, edizioni create ').count($wizard_output['savedEditions']) ?>
	</div>
	<?php if (count($wizard_output['savedEditions']) > 0) : ?>
	<table class="table table-condensed table-striped">
		<tr>
			<th><?= __('Data') ?></th>
			<th><?= __('Istruttore') ?></th>
		</tr>
		<?php foreach($wizard_output['savedEditions'] as $savedEdition) : ?>
			<tr>
				<td><?= $savedEdition->event->start_date ?></td>
				<td><?= $savedEdition->user->username ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
	<?php endif; ?>		
	<hr>
<?php endif ?>

<?= $this->Form->create($wizard); ?>

	<h3><?= __('Definizione periodo') ?></h3>
	<div class="row">
		<div class="col">
			<h4><?= __('Data inizio') ?></h4>
	        <div class="row">
	            <div class="col">
	                <label><?= __('Anno') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->year('start_date', [
	                    'value' => Time::now(),
	                    'minYear' => date('Y'),
	                ]) ;?>
	            </div>
	            <div class="col">
	                 <label><?= __('Mese') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->month('start_date', [
	                    'default' => Time::now()
	                ]) ;?>               
	            </div>
	            <div class="col">
	                <label><?= __('Giorno') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->day('start_date', [
	                    'default' => Time::now()
	                ]) ;?>               
	            </div>
	        </div>			
		</div>
		<div class="col">
			<h4><?= __('Data Fine') ?></h4>
	        <div class="row">
	            <div class="col">
	                <label><?= __('Anno') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->year('end_date', [
	                    'value' => Time::now(),
	                    'minYear' => date('Y'),
	                ]) ;?>
	            </div>
	            <div class="col">
	                 <label><?= __('Mese') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->month('end_date', [
	                    'default' => Time::now()
	                ]) ;?>               
	            </div>
	            <div class="col">
	                <label><?= __('Giorno') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->day('end_date', [
	                    'default' => Time::now()
	                ]) ;?>               
	            </div>
	        </div>			
		</div>
	</div>
	<hr>
	<h3><?= __('Orario giornaliero') ?></h3>
	<div class="row">
		<div class="col">
			<label><?= __('Dalle ore') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
			<?= $this->Form->number('daily_start_hour', ['label' => false, 'value' => 9, 'min' => 0, 'max' => 23]) ?>
		</div>
		<div class="col">
			<label><?= __('Alle ore') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
			<?= $this->Form->number('daily_end_hour', ['label' => false, 'value' => 20,  'min' => 0, 'max' => 23]) ?>
		</div>
	</div>
	<hr>
	<h3><?= __('Selezione dei giorni della settimana validi') ?></h3>
	<div class="row">
		<div class="col">
			<label><?= __('Giorni della settimana') ?></label>
			<?= $this->Form->input('week_days', ['label' => false, 'multiple' => 'checkbox', 'options' => [1 => __('Lunedì'), 2 => __('Martedì'), 3 => __('Mercoledì'), 4 => __('Giovedì'), 5 => __('Venerdì'), 6 => __('Sabato'), 7 => __('Domenica')]]) ?>
		</div>
	</div>
	<hr>
	<?= $this->Form->button(__('Esegui Wizard')) ?>
<?= $this->Form->end(); ?>
</div>