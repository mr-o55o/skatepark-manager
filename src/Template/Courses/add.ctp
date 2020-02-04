<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\LessonEdition $lessonEdition
 */
use Cake\I18n\Time;
?>

<div class="courses content">
    <?= $this->elementExists('Courses/modal-help-add') ? $this->Element('Courses/modal-help-add') : '' ?> 

    <div class="container">
	    <?= $this->Form->create($course) ?>
	    <!-- Name & Surname-->
	    <h3><?= __('Nome') ?></h3>
	    <div class="row">
	        <div class="col">
	            <label><?= __('Nome') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
	            <?= $this->Form->control('name', ['id' => 'athlete_name', 'label' => false]); ?>
	        </div>
	    </div>
	    <hr>
	    <h3><?= __('Livello') ?></h3>
	    <div class="row">
	    	<div class="col">
	    		<?= $this->Form->control('course_level_id', ['label' => false]) ?>
	    	</div>
	    </div>
	    <hr>
	    <h3><?= __('Cadenza settimanale') ?></h3>
	    <div class="row">
	    	<div class="col">
	    	<label><?= __('Scegliere i giorni della settimana in cui si svolgono le sessioni del corso.') ?></label>
	        <?= $this->Form->input('week_days', ['label' => false, 'multiple' => 'checkbox', 'options' => [1 => __('Lunedì'), 2 => __('Martedì'), 3 => __('Mercoledì'), 4 => __('Giovedì'), 5 => __('Venerdì'), 6 => __('Sabato'), 7 => __('Domenica')]]) ?>
	    	</div>
	    </div>
	    <hr>
	    <h3><?= __('Periodo') ?></h3>
	    <div class="row">
	    	<div class="col">
	    		<?= $this->Form->control('start_date') ?>
	    	</div>
	    	<div class="col">
	    		<?= $this->Form->control('end_date') ?>
	    	</div>
	    </div>
	    <hr>
	    <h3><?= __('Orario di inizio delle sessioni') ?></h3>
	    <div class="row">
	    	<div class="col">
	    		<?= $this->Form->hour('start_time', ['label' => 'Ore']) ?>
	    	</div>
	    	<div class="col">
	    		<?= $this->Form->minute('start_time', ['label' => 'Minuti']) ?>
	    	</div>	    	
	    </div>
	    <hr>
	    <h3><?= __('Durata delle sessioni (in minuti)') ?></h3>
	    <div class="row">
	    	<div class="col">
	    		<?= $this->Form->control('duration', ['label' => false, 'value' => 60]) ?>
	    	</div>	    	
	    </div>
	    <hr>
	    <h3><?= __('Prezzo') ?></h3>
	    <div class="row">
	    	<div class="col"><?= $this->Form->control('price', ['label' => false]) ?></div>
	    </div>
	    <hr>	    
	    <?= $this->Form->button(__('Submit')) ?>
	    <?= $this->Form->end() ?>
    </div>

</div>
