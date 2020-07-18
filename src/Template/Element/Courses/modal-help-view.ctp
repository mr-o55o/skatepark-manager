<?php 

?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-question-circle"></i> <?= __('Help Contestuale') ?>
    </button>
    <div class="modal fade text-left" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Visualizza Corso</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          <p>
            Da questa pagina si accede a tutte le funzioni che consentono la gestione di un corso e del suo ciclo di vita. La pagina mostra:
          </p>
            <ul>
              <li>Le caratteristiche principali del corso (nome, livello, cadenza settimanale, etc.).</li>
              <li>Gli atleti iscritti, con la possibilità, se lo stato del corso lo consente, di gestire le iscrizioni.</li>
              <li>Le sessioni del corso, con la possibilità. se lo stato del corso lo consente, di gestire le sessioni (recuperi), gli istruttori a queste assegnati ed i registri delle presenze degli atleti.</li>
            </ul>
          <p>
           Inoltre, in relazione allo stato del corso, vengono mostrati i pulsanti di accesso alle funzioni di Eliminazione, Pianificazione, Attivazione, Completamento e Cancellazione logica.
          </p>
          <h4>Pianificazione</h4>
          <p>La funzione di Pianificazione crea le sessioni del corso sulla base del periodo, della cadenza settimanale e dell'orario indicati per il corso stesso.</p>
          <h4>Attivazione</h4>
          <p>La funzione di Attivazione rende possibile creare e gestire i registri presenze per il corso.</p>
          </div>
        </div>
      </div>
    </div>