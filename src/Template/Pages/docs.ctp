<?php
//docs.ctp
?>
<h1><?= __('Skatepark Manager Documentation') ?></h1>
<hr>

<h2>Modello Logico</h2>

<h3>Principali Entità</h3>

<strong>User</strong>
<ul>
	<li>Username: (richiesto).</li>
	<li>Name: (richiesto).</li>
	<li>Surname: (richiesto).</li>
	<li>Email: (richiesto).</li>
	<li>Role: riferimento al ruolo (richiesto).</li>
	<li>Active: (richiesto).</li>
</ul>

<strong>Roles</strong>
<ul>
	<li>Name: (richiesto).</li>
	<li>Description: .</li>
</ul>

<strong>Athletes</strong>
<ul>
	<li>Name: (richiesto).</li>
	<li>Surname: (richiesto).</li>
	<li>Birthdate: (richiesto).</li>
	<li>Asi subscription date: data di iscrizione asi (richiesto).</li>
	<li>Asi subscription number: numero di iscrizione asi (richiesto).</li>
	<li>Responsible Person: riferimento al responsabile, (richiesto per u18).</li>
	<li>Notes: campo di testo libero.</li>
</ul>

<strong>Events</strong>
<ul>
	<li>Title: generalmente impostato con il nome dell'attività/servizio (richiesto).</li>
	<li>Description: descrizione, al momento non utilizzata, può tornare comoda se si vogliono registrare eventi non legati ad attività tracciate dal sistema.</li>
	<li>Start date: data e ora di inizio (richiesto).</li>
	<li>End date: data e ora di fine, generalmente impostata automaticamente in base alla durata dell'attività/servizio (richiesto).</li>
</ul>

<strong>Lesson</strong>
<ul>
	<li>Name: nome della lezione (richiesto).</li>
	<li>Description: descrizione delle sue caratteristiche.</li>
	<li>Duration: durata espressa in minuti (richiesto).</li>
	<li>Price: prezzo (richiesto), può essere 0.</li>
	<li>Trainer fee: compenso per l'istruttore (richiesto), può essere 0.</li>
</ul>

<strong>Lesson Edition</strong>
<ul>
	<li>Lesson: riferimento alla lezione di cui questa è una edizione (richiesto)</li>
	<li>Status: stato della lezione (bozza, pianificata, prenotata, completata, annullata da staff o annullata da atleta) (richiesto).</li>
	<li>Atleta: richiesto per le edizioni con status prenotata e completata</li>
	<li>Trainer: richiesto per le edizioni con status prenotata e completata</li>
	<li>Note: campo di testo per annotare info generiche sulle edizioni, presumibilmente utili al suo svolgimento corretto.</li>
	<li>Evento: riferimento all'entità evento che contiene le informazioni relative alla data e ora di svolgimento.</li>
</ul>

<strong>Lesson Editions Bundle</strong>
<ul>
	<li>Name: richiesto.</li>
	<li>Description: richiesto.</li>
	<li>Lesson Editions Count: numero di lezioni previste dal pacchetto (richiesto).</li>
	<li>Lesson: riferimento alla lezione contenuta nel pacchetto (richiesto).</li>
	<li>Active: (richiesto).</li>
	<li>Price: (richiesto).</li>

	<li><strong>Me so scordato di metterci duration pure qua!</strong></li>
</ul>

<strong>Purchased Lesson Edition Bundle</strong>
<ul>
	<li>Athlete: riferimento all'atleta (richiesto).</li>
	<li>Lesson Edition Bundle: riferimento al pacchetto (richiesto).</li>
	<li>Is Activated: registra se il pacchetto è stato attivato (l'attivazione avviene al momento del consumo della prima lezione).</li>
	<li>Start date: data di inizio validità, valorizata in fase di attivazione.</li>
	<li>End date: data di fine validità, valorizzata in fase di attivazione in base alla duration che me so scordato.</li>
</ul>

<h2>Lezioni</h2>
<p></p>

<h3>Come fare per</h3>

<h4>Aggiungere un'edizione di lezione</h4>
<p>La funzione per aggiungere una nuova edizione è presente sia nel Calendario Eventi che nella visualizzazione dei dettagli di un atleta.</p>
<p>L'operazione di aggiunta si divide in 3 fasi:</p>
<ol>
	<li>Impostazione della lezione da erogare e della data e ora di inizio.</li>
	<li>Selezione dell'istruttore e dell'atleta (nel caso si parta dalla visualizzazione atleta, questo è ovviamente preselezionato).</li>
	<li>Revisione finale e salvataggio.</li>
</ol>
<p>Istruttore e Atleta non sono obbligatori, è quindi possibile inserire edizioni incomplete che assumeranno lo status di "pianificate".</p>

<h4>Modificare un'edizione di lezione</h4>
<p>La funzionalità è disponibile nella visualizzazione dei dettagli di una edizione di lezione.</p>
<p>La modifica di una edizione è consentita solo se questa è in bozza, pianificata o prenotata. Non è possibile modificare l'atleta associato ad una edizione di lezione.</p>

<h4>Completare un'edizione di lezione</h4>
<p>Quando un'edizione di lezione viene effettivamente svolta, occorre aggiornarla per farla risultare "completata".</p>
<p>La funzionalità è disponibile nella visualizzazione dei dettagli di una edizione di lezione che si trovi in stato "prenotata".</p>
<p>Nella pagina del Calendario viene eseguita una verifica sulla presenza di edizioni "prenotate" con data superata rispetto a quella attuale e viene visualizzato un avviso.</p>

<h4>Cancellare un'edizione di lezione</h4>
<p>E' possibile identificare una lezione come cancellata su richiesta dello staff (piove cazzarola!), o su richiesta dell'atleta (attacco di cacarella al fischio)</p>
<p>Si può usare il campo "note" per aggiungere eventuali altre info sulla causa dell'annullamento.</p>
<p>Non è possibile eliminare una lezione.</p>


