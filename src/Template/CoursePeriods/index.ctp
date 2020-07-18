<?php
use Cake\Core\Configure;

?>

<div class="courses-periods index content">
    <?= $this->elementExists('CourseSubscriptions/modal-help-index') ? $this->Element('CourseSubscriptions/modal-help-index') : '' ?> 
    <?= $this->elementExists('CoursesSubscriptions/page-header') ? $this->Element('CoursesSubscriptions/page-header') : '' ; ?>

    Il Periodo Attivo è quello su cui agiscono le funzioni di pianificazione dei corsi (Creazione Classi).
    <?php if (count($coursePeriods) > 0) : ?>
        <table class="table table-striped">
            <thead class="thead">
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                    <th scope="col"><?=__('Nome') ?></th>
                    <th scope="col"><?= __('Data Inizio') ?></th>
                    <th scope="col"><?= __('Data Fine') ?></th>
                    <th scope="col"><?= __('Attivo') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coursePeriods as $period): ?>
                <tr>
                    <td class="text-center"><?= $period->id ?></td>
                    <td><?= h($period->name) ?></td>
                    <td><?= $period->start_date->i18nFormat('dd/MM/yyyy')?></td>
                    <td><?= $period->end_date->i18nFormat('dd/MM/yyyy')?></td>
                    <td>
                        <?= $period->is_active ?> 
                        <?php if ($period->is_active) : ?>
                            <?= $this->Form->postLink(__('Disattiva Periodo'), ['action' => 'deactivate', $period->id], ['class' => 'btn btn-warning btn-sm', 'confirm' => __('Disattivare il periodo {0}?', $period->name)]) ?>
                        <?php else : ?>
                            <?= ( $activePeriodsCount == 0 ? $this->Form->postLink(__('Attiva Periodo'), ['action' => 'activate', $period->id], ['class' => 'btn btn-success btn-sm', 'confirm' => __('Attivare il periodo {0}?', $period->name)]) : '')  ?>
                        <?php endif; ?>  
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- pagination -->
        <?= $this->Element('Pagination/paginator'); ?>
    <?php else : ?>
        <div class="alert alert-info"><?= __('Nessun Periodo Corsi trovato.') ?></div>
    <?php endif ?>
    <hr>
    <?= $this->Html->link( _('Definisci Nuovo Periodo'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm']) ?>
</div>