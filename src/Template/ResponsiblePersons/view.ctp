<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson $responsiblePerson
 */
?>
<div class="responsiblePersons content">
    <nav class="nav text-white rounded mb-4 justify-content-center">
      <?= $this->Html->Link( __('Modifica'), ['action' => 'edit', $responsiblePerson->id], ['class' => ['nav-link']]); ?>
    </nav>
   <h3><?= h($responsiblePerson->name) ?> <?= h($responsiblePerson->surname) ?></h3>
    <table class="table table-striped">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($responsiblePerson->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Luogo e data di nascita') ?></th>
            <td><?= h($responsiblePerson->birth_city) ?> (<?= $responsiblePerson->birth_province_code ?>) <?= __('il') ?> <?= $responsiblePerson->birth_date->i18nFormat('dd/MM/YYYY') ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Codice fiscale') ?></th>
            <td><?= h($responsiblePerson->fiscal_code) ?></td>
        </tr> 
        <tr>
            <th scope="row"><?= __('Domicilio') ?></th>
            <td><?= h($responsiblePerson->address) ?> , <?= $responsiblePerson->postal_code ?> - <?= $responsiblePerson->city ?> (<?= $responsiblePerson->province ?>) </td>
        </tr>           
        <tr>
            <th scope="row"><?= __('Email') ?></th>
            <td><?= h($responsiblePerson->email) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Telefono') ?></th>
            <td><?= h($responsiblePerson->phone) ?></td>
        </tr>
    </table>
    <hr>

    <div class="related">
        <h4><?= __('Atleti associati a questo responsabile') ?></h4>
        <?php if (!empty($responsiblePerson->athletes)): ?>
            <table  class="table table-striped">
                <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Nome e cognome') ?></th>
                </tr>
                <?php foreach ($responsiblePerson->athletes as $athlete): ?>
                <tr>
                    <td><?= $this->Html->link( $athlete->id, ['controller' => 'Athletes', 'action' => 'view', $athlete->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                    <td><?= h($athlete->name) ?> <?= h($athlete->surname) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <div class="alert alert-warning"><?= __('Nessun atleta associato a questo responsabile.') ?></div>
        <?php endif; ?>
    </div>
</div>
