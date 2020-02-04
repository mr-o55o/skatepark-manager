<?php 

?>
<div class="text-right">
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
  </button>
  <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Elenchi di lezioni</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
            <ul>
              <li>Le Lezioni individuali registrate sono suddivise in elenchi per stato: bozze, con istruttore assegnato, prenotate, completate, etc.</li>
              <li>Cliccando sul loro identificativo, si accede alla visua</li>
            </ul>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>