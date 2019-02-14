<?php
// Welcome Page to display has logged user home page
?>

<div class="content">
<h1>Benvenuto :)</h1>
<hr>

<h2>Definizioni</h2>
<p>Cominciamo dalle cose semplici, all'interno dell'applicazione si utilizzano le seguenti definizioni:</p>
	<ul>
		<li><strong><?= __('Users') ?></strong>: gli utenti dell'applicazione, ad esempio, tu sei un utente di questa applicazione.</li>
		<li><strong><?= __('Roles') ?></strong>: ogni utente ha un ruolo che gli consente di accedere ad una serie di funzioni, presumibilmente utili al ruolo che ricopre nell'organizzazione.</li>
		<li><strong><?= __('Athletes') ?></strong>: sono gli utilizzatori dello skatepark e dei suoi servizi.</li>
		<li><strong><?= __('Events') ?></strong>: il calendario per gestire i servizi dello skatepark.</li>
		<li><strong><?= __('Activities') ?></strong>: le attività di gestione del park, segreteria, apertura/chiusura, e così via.</li>
		<li><strong><?= __('Lessons') ?></strong >: le varie tipologie di lezione individuale che lo skatepark può erogare.</li>
		<li><strong><?= __('Lesson Editions') ?></strong>: le istanze delle varie tipologie di lezione, complete di data, maestro e atleta.</li>
		<li><strong><?= __('Lesson Editions Bundles') ?></strong>: sono pacchetti di lezioni (5, 10), da usarsi entro una certa data a partire dalla loro attivazione</li>
		<li><strong><?= __('Purchased Lesson Editions Bundles') ?></strong>: le solite istanze :), una volta che sono "acquistate" dagli atleti.</li>
		<li><strong><?= __('Responsible Persons') ?></strong>: le persone responsabili per gli atleti minori (il classico "Genitore o chi ne fa le veci").</li>
	</ul>


<h2>Come funziona Skatepark Manager (a grandi linee)</h2>
<p>Le funzionalità sono raggruppate in "aree di gestione" accessibili dal menu in alto, il menu a sinistra è contestuale all'area in cui ci si trova e consente di accedere alle singole funzioni dell'area.</p>

<h4><?= __('Events') ?></h4>
<p>Calendario dove si visualizzano i vari servizi e attività una volta inseriti.</p>

<h4><?= __('Users Management') ?></h4>
<ul>
	<li>Inserimento</li>
	<li>Ricerca</li>
	<li>Modifica</li>
	<li>Disattivazione</li>
</ul>
<p>Per quanto riguarda i ruoli ed i relativi permessi, al momento manca una vera e propria gestione attraverso l'applicazione stessa, quindi per modificare chi accede a cosa: contattare l'amministratore del sistema.</p>

<h4><?= __('Athletes Management') ?></h4>
per gli atleti:
<ul>
	<li>Inserimento</li>
	<li>Ricerca</li>
	<li>Modifica</li>
	<li>Aggioramento sottoscrizione ASI</li>
	<li>Visualizzaizone storico servizi utilizzati</li>
</ul>
per i responsabili:
<ul>
	<li>Inserimento</li>
	<li>Ricerca</li>
	<li>Modifica</li>
</ul>

<h4><?= __('Lessons Management') ?></h4>
per le lezioni:
<ul>
	<li>Inserimento</li>
	<li>Modifica (Attivazione/Disattivazione)</li>
</ul>
per le edizioni:
<ul>
	<li>Inserimento</li>
	<li>Modifica</li>
	<li>Completamento</li>
	<li>Annullamento</li>
	<li>Visualizzazione edizioni prenotate</li>
</ul>
per i pacchetti di lezioni:
<ul>
	<li>Inserimento</li>
	<li>Modifica</li>
	<li>Assegnazione</li>
</ul>

<h4><?= __('Activities Management') ?></h4>
<p>Gestione delle attività: definizione di nuove attività, modifica delle attività esistenti se non ancora utilizzate.</p>
</div>

