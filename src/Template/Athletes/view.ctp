<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Athlete $athlete
 */

use Cake\I18n\Time;

?>
<div class="content">
    <nav class="nav text-white rounded mb-4 justify-content-center">
        <?= $this->Html->link( __('Modifica atleta'), ['action' => 'edit', $athlete->id], ['class' => ['nav-link']]); ?>
        <?= $this->Html->link(_('Prenota una lezione per questo atleta'), ['controller' => 'LessonEditions', 'action' => 'addBooked', '?' => ['athlete_id' => $athlete->id] ], ['class' => 'nav-link']); ?>
        <?= ($countValidLessonEditionsBundles == 0 ? $this->Html->link(_('Assegna un pacchetto di lezioni a questo atleta'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'buyFor', $athlete->id ], ['class' => 'nav-link']): '') ?>
    </nav>

    <h3><?= __('Dati Anagrafici') ?></h3>
    <diiv class="row">
        <div class="col"><?= __('Nome e Cognome') ?>: <?= h($athlete->name) ?> <?= h($athlete->surname) ?></div>
        <div class="col"><?= __('Sesso') ?>: <?= h($athlete->sex) ?></div>
        <div class="col"><?= __('Data e luogo di nascita') ?>: <?= h($athlete->birth_city) ?> (<?= h($athlete->birth_province_code) ?>) <?= __('il') ?> <?=$athlete->birthdate->i18nFormat('dd/MM/YYYY')?></div>
        <div class="col"><?= __('Codice fiscale') ?>: <?= h($athlete->fiscal_code) ?></div>
    </diiv>
    <hr>
    <h3><?= __('Altri Dati') ?></h3>
    <div class="row">
        <div class="col"><?= __('Età') ?>: <?= h($athlete->birthdate->diffInYears(Time::now())) ?></div>
        <div class="col"><?= __('Disabile') ?>: <?= ($athlete->disabled_person ? 'Si' : 'No') ?></div>
        <div class="col"><?= __('Agonista') ?>: <?= ($athlete->competitive ? 'Si' : 'No') ?></div>
    </div>
    <hr>
    <h3><?= __('Iscrizioni') ?></h3>
    <div class="row">
        <div class="col">
            <div class="row">
                <div class="col">
                    <h4><?= __('ASI') ?></h4>
                    <?= (isset($athlete->asi_subscription_date) ? $athlete->asi_subscription_date->i18nFormat('dd/MM/YYYY').' '.h($athlete->asi_subscription_number) : __('Nessuna data di iscrizione')) ?>                   
                </div>
                <div class="col">
                    <h4><?= __('FISR') ?></h4>
                    <?= (isset($athlete->fisr_subscription_date) ? $athlete->fisr_subscription_date->i18nFormat('dd/MM/YYYY').' '.h($athlete->fisr_subscription_number) : __('Nessuna data di iscrizione')) ?>                   
                </div>
            </div>
            <?php if ($athlete->hasValidSubscriptions() === false) : ?>
                <hr>
                <div class="alert alert-warning">
                    <p><?= __('L\'atleta non ha iscrizioni in corso di validità.') ?></p>
                    <?= $this->Html->link('Scarico di responsabilità', ['action' => 'viewLiabilityDisclaimer', $athlete->id]) ?>
                    <?= $this->Html->link(__('Rinnova le iscrizioni per questo atleta'), ['action' => 'renewSubscriptions', $athlete->id], ['class' => 'btn btn-primary btn-sm']) ?>
                </div>
            <?php endif; ?>                 
        </div>
    </div>
    <hr>
    <h3><?= __('Domicilio') ?></h3>
    <div class="row">
        <div class="col"><?= h($athlete->address) ?>  <?= $athlete->postal_code ?> - <?= $athlete->city ?> (<?= $athlete->province_code ?>)</div>
    </div>
    <hr>
    <h3><?= __('Contatti') ?></h3>
    <div class="row">
        <div class="col"><i class="fa fa-phone"></i>: <?= h($athlete->phone) ?></div>
        <div class="col"><i class="fa fa-envelope"></i>:: <?= h($athlete->email) ?></div>
        <div class="col"><i class="fab fa-twitter"></i>: <?= h($athlete->twitter_account) ?></div>
        <div class="col"><i class="fab fa-instagram"></i>: <?= h($athlete->instagram_account) ?></div>
    </div>
    <hr>
    <?php if ($athlete->has('responsible_person')) : ?>
        <h3><?= __('Persone Responsabili') ?></h3>
        <div class="row">
            <div class="col">
                <ul class="list-unstyled">
                    <li><?= $this->Html->link($athlete->responsible_person->name . ' ' . $athlete->responsible_person->surname, ['controller' => 'ResponsiblePersons', 'action' => 'view', $athlete->responsible_person_id]) ?></li>
                    <li><i class="fa fa-phone"></i>: <?= h($athlete->responsible_person->phone) ?></li>
                    <li><i class="fa fa-envelope"></i>: <?= h($athlete->responsible_person->email) ?></li>
                </ul>
            </div>
        </div>
        <hr>
    <?php endif ?>
    <h3><?= __('Appunti') ?></h3>
    <div class="row">
        <div class="col">
            <?php if (count($athlete->athletes_notes) > 0) : ?>
                <table class="table table-condensed">
                    <tr>
                        <th><?= __('Data') ?></th>
                        <th><?= __('Appunto') ?></th>
                        <th><?= __('Autore') ?></th>
                        <th>&nbsp;</th>
                    </tr>
                    <?php foreach ($athlete->athletes_notes as $note) : ?>
                        <tr>
                            <td><?= $note['created'] ?></td>
                            <td><?= h($note['note'])?></td>
                            <td><?= h($note->user->username)?></td>
                            <td><?= $this->Form->postLink(__('Elimina'), ['controller' => 'AthletesNotes', 'action' => 'delete', $note->id], ['confirm' => __('Rimuovere l\'appunto?'), 'class' => 'btn btn-danger btn-sm']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?= $this->Html->link(__('Aggiungi appunto'), ['controller' => 'AthletesNotes', 'action' => 'add', 'athlete_id' => $athlete->id], ['class' => 'btn btn-primary btn-sm']) ?>
            <?php endif; ?>            
        </div>
    </div>
    <hr>
    <h4 class="text-center"><?= __('Riassunto servizi utilizzati da questo atleta') ?></h4>
    <h5><?= __('Lezioni individuali') ?></h5>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 20%;"><?= __('Attualmente prenotate') ?></th>
                <th class="text-center" style="width: 20%;"><?= __('Completate') ?></th>
                <th class="text-center" style="width: 20%;"><?= __('Cancellate su richiesta dell\'atleta') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-right"><?= $this->Number->format($countBookedLessonEditions) ?></td>
                <td class="text-right"><?= $this->Number->format($countCompletedLessonEditions) ?></td>
                <td class="text-right"><?= $this->Number->format($countCancelledLessonEditions) ?></td>
                <td class="text-center"><?= $this->Html->link(__('Tutte le lezioni individuali che includono questo atleta'), ['controller' => 'LessonEditions', 'action' => 'indexForAthlete', $athlete->id]) ?></td>
            </tr>
        </tbody>
    </table>
    
    
    <h5><?= __('Pacchetti di lezioni individuali') ?></h5>

    <?php if ($validBundles) : ?>
        <div class="alert alert-info"><?= __('L\'atleta ha un pacchetto di lezioni attualmente attivo.') ?></div>
        <table class="table table-condensed">
        <?php foreach($validBundles as $validBundle) : ?>
            <tr>
                <td><?= h($validBundle->id) ?></td>
                <td></td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <table class="table">
        <thead>
            <tr>
                <th class="text-center" style="width: 25%;"><?= __('Attualmente validi') ?></th>
                <th class="text-center" style="width: 25%;"><?= __('Acquistati') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-right"><?= $this->Number->format($countValidLessonEditionsBundles) ?></td>
                <td class="text-right"><?= $this->Number->format($countPurchasedLessonEditionsBundles) ?></td>
                <td class="text-center"><?= $this->Html->link(__('Tutti i pacchetti di lezione acquistati da questo atleta'), ['controller' => 'PurchasedLessonEditionsBundles', 'action' => 'indexForAthlete', $athlete->id]) ?></td>
            </tr>
        </tbody>
    </table>
</div>
