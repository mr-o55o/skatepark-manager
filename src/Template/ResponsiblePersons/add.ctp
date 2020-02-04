<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson $responsiblePerson
 */
?>

<div class="responsiblePersons content">
    <!-- Contextual Help -->
    <div class="text-right"><?= $this->Element('ResponsiblePersons/modal-help-add') ?></div>

    <?= ($responsiblePerson->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $responsiblePerson->getErrors() ]) : '' ) ?>
    <?= $this->Form->create($responsiblePerson) ?>
    <h3><?= __('Nome e cognome') ?></h3>
    <div class="row">
        <div class="col"><label><?= __('Nome') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->control('name', ['label' => false]); ?></div>
        <div class="col"><label><?= __('Nome') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->control('surname', ['label' => false]); ?></div> 
    </div>
    <hr>
    <h3><?= __('Data e luogo di nascita') ?></h3>
    <div class="row">
        <div class="col form-group required">
            <label><?= __('Giorno') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->day('birth_date', ['label' => false, 'required' => true]); ?>
        </div>
        <div class="col form-group required">
            <label><?= __('Mese') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->month('birth_date', ['label' => false, 'required' => true]); ?>
        </div>
        <div class="col- form-group required">
            <label><?= __('Anno') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->year('birth_date', [ 'label' => false, 'minYear' => 1900, 'required' => true ]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label><?= __('Città') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('birth_city', ['label' => false, 'required' => true])?>
        </div>
        <div class="col">
            <label><?= __('Provincia o Stato Estero') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->control('birth_province_code', [ 'options' => $provinces, 'label' => false, 'required' => true, 'empty' => __('Selezionare una provincia o scegliere Stato Estero') ]);?>
        </div>
    </div>
    <hr>
    <h3><?= __('Codice Fiscale') ?></h3>
    <div class="row">
        <div class="col">
            <p>Il codice fiscale è controllato solo formalmente.</p>
        </div>
        <div class="col">
            <label><?= __('Codice Fiscale') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->control('fiscal_code', ['label' => false]) ?>
        </div>
    </div>
    <hr>
    <h3><?= __('Domicilio') ?></h3>
    <div class="row">
        <div class="col">
            <label><?= __('Indirizzo') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('address', ['label' => false, 'required' => true])?> 
        </div>
        <div class="col">
            <label><?= __('Città') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('city', ['label' => false, 'required' => true])?>               
        </div>
        <div class="col">
            <label><?= __('Provincia o stato estero') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->control('province_code', [ 'options' => $provinces, 'label' => false, 'required' => true, 'empty' => __('Provincia o Stato Estero') ]);?>          
        </div>
        <div class="col">
            <label><?= __('CAP') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('postal_code', ['label' => false, 'required' => true])?> 
        </div>
    </div>
    <hr>
    <h3><?= __('Contatti') ?></h3>
    <div class="row">
            <div class="col">
                <label><?= __('Email') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('email', [ 'label' => false, 'required' => true ])?>
            </div>
            <div class="col">
                <label><?= __('Phone') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('phone', [ 'label' => false, 'required' => true ])?>
            </div>
    </div>
    <hr>
    <p><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campo obbligatorio') ?></p>
    <div class="text-center"><?= $this->Form->button(__('Salva responsabile')) ?></div>
    <?= $this->Form->end() ?>
</div>
