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
          <h5 class="modal-title">Prenotazione di una nuova lezione individuale</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>
              Per creare una nuova lezione individuale completa di tutti i suoi elementi:
              <ol>
                  <li>Selezionare il tipo di lezione individuale</li>
                  <li>Selezionare data e ora di inizio</li>
                  <li>Procedere alla selezione di istruttore ed atleta</li>
                  <li>Selezionare l'istruttore</li>
                  <li>Selezionare l'atleta</li>
                  <li>Procedere alla revisione dei dati della lezione</li>
                  <li>Confermare la creazione della nuova lezione</li>
              </ol>
              La lezione sarà salvata in stato "prenotata".
          </p>
        </div>
      </div>
    </div>
  </div>
</div>