<?php 

?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
    </button>
    <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Creazione di una nuova Attività</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>
                Per creare una nuova attività:
                <ol>
                    <li>Selezionare il tipo di attività.</li>
                    <li>Impostare la data e l'ora di inizio, non è possibile definire attività nel passato.</li>
                    <li>Impostare una durata, tenendo presente che l'attività deve necessariamente terminare nello stesso giorno in cui inizia.</li>
                    <li>Opzionalmente, digitare un titolo che verrà attribuito all'evento associato all'attività; se non specificato, il titolo dell'evento viene valorizzato con il tipo di attività.</li>
                    <li>Salvata l'attività ,si procede all'aggiunta dei membri dello staff che la realizzano.</li>
                </ol>
            </p>
          </div>
        </div>
      </div>
    </div>