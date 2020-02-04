<?php 

?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
    </button>
    <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registrazione di una nuova persona responsabile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                Per registrare una nuova persona responsabile:
                <ol>
                    <li>Compilare i dati anagrafici.</li>
                    <li>Una persona responsabile non può avere meno di 18 anni...</li>
                </ol>
            </p>
          </div>
        </div>
      </div>
    </div>