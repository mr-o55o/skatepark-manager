<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */

use Cake\Core\Configure;
$this->Form->unlockField('responsible_person_id');
?>

<div class="athletes content">
    <!-- Contextual Help -->
    <div class="text-right"><?= $this->Element('Athletes/modal-help-add') ?></div>

    <?= ($athlete->getErrors() ? $this->Element('Errors/error_box', [ 'errors' => $athlete->getErrors() ]) : '' ) ?>

    <?= $this->Form->create($athlete) ?>
        <!-- Name & Surname-->
        <h3><?= __('Dati Anagrafici') ?></h3>
        <h4><?= __('Nome e Cognome') ?></h4>
        <div class="row">
            <div class="col">
                <label><?= __('Nome') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('name', ['id' => 'athlete_name', 'label' => false]); ?>
            </div>
            <div class="col">
                <label><?= __('Cognome') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('surname', ['id' => 'athlete_surnamename', 'label' => false]); ?>
            </div>
        </div>
        <h4><?= __('Sesso, Data e luogo di nascita') ?></h4>
        <div class="row">
            <div class="col form-group required">
                <label><?= __('Sesso') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->control('sex', ['options' => ['M', 'F'],'label' => false]); ?>
            </div>
            <div class="col form-group required">
                <label><?= __('Giorno') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->day('birthdate', ['label' => false]); ?>
            </div>
            <div class="col form-group required">
                <label><?= __('Mese') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->month('birthdate', ['label' => false]); ?>
            </div>
            <div class="col- form-group required">
                <label><?= __('Anno') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                <?= $this->Form->year('birthdate', [ 'label' => false, 'minYear' => Configure::read('Athletes')['birthdate_minYear'], 'maxYear' => date('Y') ]); ?>
            </div>
        </div>
        <hr>
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
        <h3>Domicilio</h3>
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
        <!-- ASI Subscription-->
        <h3><?= __('Iscrizione ASI') ?></h3>
        <div class="row">
            <div class="col form-group required">
                <label><?= __('Giorno') ?></label>
                <?= $this->Form->day('asi_subscription_date'); ?>
            </div>
            <div class="col form-group required">
                <label><?= __('Mese') ?></label>
                <?= $this->Form->month('asi_subscription_date'); ?>
            </div>
            <div class="col form-group required">
                <label><?= __('Anno') ?></label>
                <?= $this->Form->year('asi_subscription_date'); ?>
            </div>
        </div>
        <div>
            <label><?= __('Numero') ?></label>
            <?= $this->Form->control('asi_subscription_number', ['label' => false]); ?>
        </div>
        <hr>
        <!-- Responsible Person-->
        <h3><?= __('Persona Responsabile') ?></h3>
        <span class=""><?= __('Richiesto per atleti under 18') ?></span>
        <div class="row">
            <div class="col">
                 <label><?= __('Digitare parte del cognome del responsabile da assegnare a questo atleta e premere cerca, quindi selezionare uno dei nominativi restituiti.')?></label>
                <?= $this->Form->input('responsible_person_surname', ['id' => 'responsible-person-surname', 'label' => false]) ?>
                <a id="search-responsible-person-button" class="btn btn-primary text-white"><?= __('Cerca') ?></a>               
            </div>
            <div class="col" >
                <strong><?= __('Risultati della ricerca') ?></strong>
                <div id="target-responsible-person">

                </div>
            </div>
        </div>
        <hr>
        <!-- Contacts -->
        <h3><?= __('Contatti') ?></h3>
        <div class="row">
                <div class="col form-group required">
                    <label><?= __('Email') ?> <i class="fas fa-star fa-xs text-danger"></i></label>
                    <?= $this->Form->control('email', ['label' => false])?>
                </div>
                <div class="col form-group">
                    <label><?= __('Phone') ?></label>
                    <?= $this->Form->control('phone', ['label' => false])?>
                </div>
        </div>
        <div class="row">
                <div class="col form-group">
                    <label><?= __('Account Twitter') ?></label>
                    <?= $this->Form->control('twitter_account', ['label' => false])?>
                </div>
                <div class="col form-group required">
                    <label><?= __('Account Instagram') ?></label>
                    <?= $this->Form->control('instagram_account', ['label' => false])?>
                </div>
        </div>
        <hr>
        <label><i class="fas fa-star fa-xs text-danger"></i> <?= __('Campi richiesti') ?></label>
        <div class="text-center"><?= $this->Form->button(__('Registra Atleta')) ?></div>
    <?= $this->Form->end() ?>
</div>

<script language="javascript">
    $('#search-responsible-person-button').click(function() {
        $('#target-responsible-person').empty();
        var searchString = $('#responsible-person-surname').val();
        var targeturl = '/responsible-persons/ajax-search.json?surname=' + searchString;
        $.ajax({
            type: 'get',
            url: targeturl,
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Content-type', 'application/json');
            },
            success: function(response) {
                console.log('Displaying search results');
                $('#target-responsible-person').append('<label><?=__('Select a responsible person')?></label><br>');
                $.each(response.responsible_persons, function( index, value ) {
                    console.log(index + ": "+ value['name']);
                    $('#target-responsible-person').append('<input type="radio" name="responsible_person_id" value="' + value['id'] + '" /> ' + value['name'] + ' ' + value['surname'] + '<br>');
                });                        
            },
            error: function(e) {
                alert("An error occurred: " + e.responseText.message);
                console.log(e);
            }
        });
    });
</script>