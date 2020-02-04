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
    <h3><?= __('Dati Anagrafici') ?></h3>
    <diiv class="row">
        <div class="col-4"><label><?= __('Nome e Cognome') ?>:</label> <?= h($responsiblePerson->name) ?> <?= h($responsiblePerson->surname) ?></div>
        <div class="col-4"><label><?= __('Nato a') ?>:</label> <?= h($responsiblePerson->birth_city) ?> (<?= h($responsiblePerson->birth_province_code) ?>) <?= __('il') ?> <?=$responsiblePerson->birth_date->i18nFormat('dd/MM/YYYY')?></div>
        <div class="col-4"><label><?= __('Codice fiscale') ?>:</label> <?= h($responsiblePerson->fiscal_code) ?></div>
    </diiv>
    <hr>
    <h3><?= __('Domicilio') ?></h3>
    <div class="row">
        <div class="col-3">
            <label><?= __('Via / Piazza') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('address', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('CAP') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('postal_code', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('Città') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->input('city', ['label' => false]) ?>
        </div>
        <div class="col-3">
            <label><?= __('Provincia') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
            <?= $this->Form->control('birth_province_code', [ 'options' => $provinces, 'label' => false, 'required' => true, 'empty' => __('Selezionare una provincia o scegliere Stato Estero') ]);?>
        </div>
    </div>
    <hr>
    <h3><?= __('Contatti') ?></h3>
    <div class="row">
        <div class="col"><label><?= __('Telefono') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->control('phone', ['label' => false]); ?></div>
        <div class="col"><label><?= __('Email') ?> <i class="fas fa-star fa-xs text-danger"></i></label> <?= $this->Form->control('email', ['label' => false]); ?></div>
    </div>    
    <hr>
    <label><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campi richiesti') ?></label>
    <div class="text-center"><?= $this->Form->button(__('Aggiorna dati del responsabile')) ?></div>
    <?= $this->Form->end() ?>
</div>
