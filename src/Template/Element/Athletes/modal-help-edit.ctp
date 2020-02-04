<?php 

?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
    </button>
    <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Modifica di un atleta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                <ol>
                    <li>I dati anagrafici non possono essere modificati</li>
                    <li>Il responsabile è un elemento richiesto per gli atleti di entà inferiore a 18 anni.</li>
                </ol>
            </p>
          </div>
        </div>
      </div>
    </div>