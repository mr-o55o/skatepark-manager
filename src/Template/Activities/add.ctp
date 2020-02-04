<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Activity $activity
 */
use Cake\I18n\Time;
?>

<div class="activity content">
    <!-- Contextual Help -->
    <div class="text-right"><?= $this->Element('Activities/modal-help') ?></div>

    <!-- Business Errors Recap-->
    <?= ($activity->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $activity->getErrors() ]) : '' ) ?>

    <!-- Activity Form -->
    <?= $this->Form->create($activity, ['id' => 'add-activity-form']) ?>
        <h3><?= __('Tipo di attività') ?> </h3>
        <div class="row">
            <div class="col">
                <label><?= __('Selezionare una tipologia di attività') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('activity_type_id', ['options' => $activity_types, 'label' => false, 'empty' => true, 'required' => true]); ?>
            </div>
        </div>
        
        <hr>
        <h3><?= __('Data,ora di inizio e durata') ?> <i class="fas fa-star fa-xs text-danger"></i></h3>
        <div class="row">
            <div class="col">
                <label><?= __('Anno') ?></label> <?= $this->Form->year('event.start_date', [
                    'value' => Time::now(),
                    'minYear' => date('Y'),
                ]) ;?>
            </div>
            <div class="col">
                 <label><?= __('Mese') ?></label> <?= $this->Form->month('event.start_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
            <div class="col">
                <label><?= __('Giorno') ?></label> <?= $this->Form->day('event.start_date', [
                    'default' => Time::now()
                ]) ;?>               
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label><?= __('Ore') ?></label> <?= $this->Form->hour('event.start_date', []); ?>
            </div>
            <div class="col">
                <label><?= __('Minuti') ?></label> <?= $this->Form->minute('event.start_date', [
                    'interval' => 15,
                ]); ?>
            </div>
             <div class="col">
                <label><?= __('Durata in ore') ?></label> <?= $this->Form->number('duration', ['min' => 1, 'required' => true]); ?> 
            </div>           
        </div>
        <hr>
        <h3><?= __('Evento associato') ?></h3>
        <div class="row">
            <div class="col">
                <label><?= __('Titolo da assegnare all\'evento associato') ?></label>
                <?= $this->Form->input('event.title', ['value' => 'Nessun titolo', 'label' => false]) ?>  
            </div>
        </div>
        <hr>
        <h3><?= __('Altro') ?></h3>
        <div class="row">
            <div class="col">
                <label><?= __('Note') ?></label>
                <?= $this->Form->input('notes', ['label' => false]) ?>
            </div>
        </div>
        <hr>
        <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campo obbligatorio') ?></p>
        <div class="text-center"><?= $this->Form->submit(__(_('Salva attività'))); ?></div>
    <?= $this->Form->end() ?>
</div>
<!--
<script src="/js/jquery.validate.min.js"></script>

<script>
    $('add-activity-form').validate({
        rules: {
            'activity_type_id': {
                required: true,
            },
        },
        messages: {
            'activity_type_id': {
                required: "Selezionare un tipo di attività",
            },
        },
    });
</script>
-->