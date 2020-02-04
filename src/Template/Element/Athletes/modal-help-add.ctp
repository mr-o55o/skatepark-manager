<?php 

?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
    </button>
    <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registrazione di un nuovo atleta</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                Per registrare un nuovo atleta:
                <ol>
                    <li>Compilare i dati anagrafici dell'atleta</li>
                    <li>L'iscrizione ASI, pur non essendo obblgatoria per poter registrare l'atleta, è necessaria per poter selezionare questo atleta come partecipante a corsi e lezioni individuali. Nel caso di una lazione di prova, è possibile visualizzare e stampare lo scarico di responsabilità.</li>
                    <li>Il responsabile è un elemento richiesto per gli atleti di entà inferiore a 18 anni.</li>
                </ol>
            </p>
          </div>
        </div>
      </div>
    </div>