<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson[]|\Cake\Collection\CollectionInterface $responsiblePersons
 */
?>
<div class="responsiblePersons index large-9 medium-8 columns content">
    <h3><?= __('Athletes Management') ?> - <?= __('Responsible Persons') ?></h3>
    <small><?= __('Responsible persons are  required for under 18 athletes') ?></small>
    <div class="text-right">
        <?= $this->Html->Link( __('Sign Up a new responsible person'), ['action' => 'add'], ['class' => ['btn', 'btn-primary']]); ?>
        <?= $this->Html->Link( __('Search for a responsible person'), ['action' => 'search'], ['class' => ['btn', 'btn-primary']]); ?>
    </div>
    <hr>
<?php
    echo $this->Form->create(null, ['valueSources' => 'query']);
    // Match the search param in your table configuration
    echo $this->Form->control('q', ['label' => __('Search text in username, name, surname and email fields')]);
    echo $this->Form->button('Filter', ['type' => 'submit']);
    echo $this->Html->link('Reset', ['action' => 'index']);
    echo $this->Form->end();
?>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                <th scope="col"><?= $this->Paginator->sort('surname') ?></th>
                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                <th scope="col"><?= $this->Paginator->sort('phone') ?></th>
                <th scope="col"><?= $this->Paginator->sort('fiscal_code') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($responsiblePersons as $responsiblePerson): ?>
            <tr>
                <td><?= $this->Number->format($responsiblePerson->id) ?></td>
                <td><?= h($responsiblePerson->name) ?></td>
                <td><?= h($responsiblePerson->surname) ?></td>
                <td><?= h($responsiblePerson->email) ?></td>
                <td><?= h($responsiblePerson->phone) ?></td>
                <td><?= h($responsiblePerson->fiscal_code) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $responsiblePerson->id], ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $responsiblePerson->id], ['class' => 'btn btn-primary']) ?>
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
