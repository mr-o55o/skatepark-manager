<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson $responsiblePerson
 */
?>
<?= $this->element('Errors/error_box'); ?>
<div class="responsiblePersons content">
    <h3>
      <?= __('Athletes Management') ?> - <?= __('Add new responsible person') ?>
    </h3> 
    <?= $this->Form->create($responsiblePerson) ?>
    <fieldset>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('fiscal_code', ['label' => _('Fiscal code (formal check)')]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
