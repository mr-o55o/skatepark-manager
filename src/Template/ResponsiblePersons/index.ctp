<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson[]|\Cake\Collection\CollectionInterface $responsiblePersons
 */
?>
<div class="responsiblePersons index content">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= __('Nome e cognome') ?></th>
                <th scope="col"><?= __('Email') ?></th>
                <th scope="col"><?=__('Telefono') ?></th>
                <th scope="col"><?= __('Responsabile per') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($responsiblePersons as $responsiblePerson): ?>
            <tr>
                <td><?= $this->Html->link( $responsiblePerson->id, ['action' => 'view', $responsiblePerson->id], ['class' => 'btn btn-primary btn-sm']) ?></td>
                <td><?= h($responsiblePerson->name).' '.h($responsiblePerson->surname) ?></td>
                <td><?= h($responsiblePerson->email) ?></td>
                <td><?= h($responsiblePerson->phone) ?></td>
                <td>
                    <?php if (count($responsiblePerson->athletes) > 0) : ?>
                        <ul class="list-unstyled">
                        <?php foreach ($responsiblePerson->athletes as $athlete) : ?>
                            <li><?= $this->Html->link(h($athlete->name).' '.h($athlete->surname), ['controller' => 'Athletes', 'action' => 'view', $athlete->id]) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <div class="alert alert-warning"><?= __('Attenzione! Nessun atleta associato.') ?></div>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
