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
	    <h3><?= __('Prezzo') ?></h3>
	    <div class="row">
	    	<div class="col"><?= $this->Form->control('price', ['label' => false]) ?></div>
	    </div>
	    <hr>	    
	    <?= $this->Form->button(__('Submit')) ?>
	    <?= $this->Form->end() ?>
    </div>

</div>
