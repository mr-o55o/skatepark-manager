<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ResponsiblePerson $responsiblePerson
 */
?>
<?= $this->element('Errors/error_box'); ?>
<div class="responsiblePersons content">
    <h3>
      <?= __('Athletes Management') ?> - <?= __('Edit Responsible Person data') ?>
    </h3>
    <small><?= __('Edit responsible person details') ?></small>
    <hr> 
    <?= $this->Form->create($responsiblePerson) ?>
    <fieldset>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('surname');
            echo $this->Form->control('email');
            echo $this->Form->control('phone');
            echo $this->Form->control('fiscal_code');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
