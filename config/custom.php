<?php
return [
	//layout used for private area
	'private-layout' => 'private',

	//main navigation
	'topics' => [
		'Home' => [
			'name' => 'Home',
			'home' => ['controller' => 'Pages', 'action' => 'display'],
		],
		'Events' => [
			'name' => 'Eventi',
			'home' => ['controller' => 'Events', 'action' => 'calendar'],
		],
		'Administration' => [
			'name' => 'Area di amministrazione',
			'home' => ['controller' => 'Administration', 'action' => 'index'],
		],
		'AthletesManagement' => [
			'name' => 'Gestione Atleti',
			'home' => ['controller' => 'Athletes', 'action' => 'index'],
		],
		'LessonsManagement' => [
			'name' => 'Gestione Lezioni',
			'home' => ['controller' => 'LessonEditions', 'action' => 'indexBooked'],
		],
		'ActivitiesManagement' => [
			'name' => 'Gestione Attiità',
			'home' => ['controller' => 'Activities', 'action' => 'index'],
		],
	],

	'main_nav' => [
		
		'Pages' => [
			'display' => [
				'name' => 'Home',
				'topic' => 'Home',
			],
		],

		'Users' => [
			'index' => [
				'name' => 'Elenco utenti',
				'topic' => 'Administration',
			],
				'add' => [
					'name' => 'Aggiungi utente',
					'topic' => 'Admnistration',
			],
				'view' => [
					'name' => 'Visualizza utente',
					'topic' => 'Admnistration',
			],
				'edit' => [
					'name' => 'Modifica utente',
					'topic' => 'Admnistration',
			],
		],
	
		'Roles' => [
			'index' => [
				'name' => 'Elenco ruoli',
				'topic' => 'Administration',
			],
			'view' => [
				'name' => 'Visualizza ruolo',
				'topic' => 'Administration',
			],

		],
	
		'Athletes' => [
			'index' => [
				'name' => 'Elenco atleti',
				'topic' => 'AthletesManagement',
			],
			'add' => [
				'name' => 'Registra un nuovo atleta',
				'topic' => 'AthletesManagement',
			],
			'view' => [
				'name' => 'Visualizza atleta',
				'topic' => 'AthletesManagement',
			],
			'edit' => [
				'name' => 'Modifica atleta',
				'topic' => 'AthletesManagement',
			],
			'renewAsiSubscription' => [
				'name' => 'Rinnova sottoscrizione ASI',
				'topic' => 'AthletesManagement',
			],			
		],

		'ResponsiblePersons' => [
			'index' => [
				'name' => 'Elenco responsabili',
				'topic' => 'AthletesManagement',
			],
			'add' => [
				'name' => 'Registra un nuovo responsabile',
				'topic' => 'AthletesManagement',
			],
			'view' => [
				'name' => 'Visualizza responsabile',
				'topic' => 'AthletesManagement',
			],
			'edit' => [
				'name' => 'Modifica responsabile',
				'topic' => 'AthletesManagement',
			],			
		],

		'Events' => [
			'index' => [
				'name' => 'Elenco eventi',
				'topic' => 'Events',
			],	
			'calendar' => [
				'name' => 'Calendario eventi',
				'topic' => 'Events',
			],	
		],

		'ActivityTypes' => [
			'index' => [
				'name' => 'Elenco tipi di attività',
				'topic' => 'ActivitiesManagement',
			],	
			'add' => [
				'name' => 'Definisci un nuovo tipo di attività',
				'topic' => 'Administration',
			],
			'view' => [
				'name' => 'Visualizza dettagli tipo di attività',
				'topic' => 'Administration',
			],
			'edit' => [
				'name' => 'Modifica tipo di attività',
				'topic' => 'Administration',
			],

		],		

		'Activities' => [
			'index' => [
				'name' => 'Elenco attività',
				'topic' => 'ActivitiesManagement',
			],	
			'indexUpcoming' => [
				'name' => 'Elenco attività in programma',
				'topic' => 'ActivitiesManagement',
			],
			'add' => [
				'name' => 'Programma una nuova attività',
				'topic' => 'ActivitiesManagement',
			],
			'populate' => [
				'name' => 'Riempi attività',
				'topic' => 'ActivitiesManagement',
			],

			'view' => [
				'name' => 'Visualizza attività',
				'topic' => 'ActivitiesManagement',
			],
			'edit' => [
				'name' => 'Modifica attività',
				'topic' => 'ActivitiesManagement',
			],
		],
		
		'Lessons' => [
			'index' => [
				'name' => 'Elenco Tipi di lezione',
				'topic' => 'LessonsManagement',
			],
			'add' => [
				'name' => 'Definisci un nuovo tipo di lezione',
				'topic' => 'Administration',
			],
			'view' => [
				'name' => 'Visualizza dettagli tipo di lezione',
				'topic' => 'LessonsManagement',
			],
			'edit' => [
				'name' => 'Modifica tipo di lezione',
				'topic' => 'Administration',
			],
		],
		
		'LessonEditions' => [
			'index' => [
				'name' => 'Elenco lezioni',
				'topic' => 'LessonsManagement',
			],
			'indexBooked' => [
				'name' => 'Elenco Lezioni Prenotate',
				'topic' => 'LessonsManagement',
			],
			'add' => [
				'name' => 'Aggiungi nuova lezione',
				'topic' => 'LessonsManagement',
			],
			'view' => [
				'name' => 'Visualizza lezione',
				'topic' => 'LessonsManagement',
			],			
			'populate' => [
				'name' => 'Popola nuova lezione',
				'topic' => 'LessonsManagement',
			],
			'review' => [
				'name' => 'Salva nuova lezione',
				'topic' => 'LessonsManagement',
			],
			'complete' => [
				'name' => 'Completa lezione',
				'topic' => 'LessonsManagement',
			],
			'cancel' => [
				'name' => 'Cancella lezione',
				'topic' => 'LessonsManagement',
			],
			'edit' => [
				'name' => 'Modifica lezione',
				'topic' => 'Administration',
			],
		],
		
		'LessonsEditionsBundles' => [
			'index' => [
				'name' => 'Elenco tipi di pacchetti di lezioni',
				'topic' => 'LessonsManagement',
			],
			'add' => [
				'name' => 'Definisci un nuovo tipo di pacchetto di lezioni',
				'topic' => 'Admnistration',
			],
			'view' => [
				'name' => 'Visualizza dettagli tipo di pacchetto di lezioni',
				'topic' => 'Admnistration',
			],
		],
		
		'PurchasedLessonEditionsBundles' => [
			'index' => [
				'name' => 'Elenco pacchetti di lezione acquistati',
				'topic' => 'LessonsManagement',
			],
			'indexActive' => [
				'name' => 'Elenco pacchetti di lezione attivi',
				'topic' => 'LessonsManagement',
			],
			'indexToExpire' => [
				'name' => 'Elenco pacchetti che hanno superato la data di validità',
				'topic' => 'LessonsManagement',
			],
			'view' => [
				'name' => 'Visualizza pacchetto di lezioni',
				'topic' => 'LessonsManagement',
			],
			'buyFor' => [
				'name' => 'Assegna pacchetto di lezioni',
				'topic' => 'LessonsManagement',
			],			
		],

		'Administration' => [
			'index' => [
				'name' => 'Area di Amministrazione',
				'topic' => 'Administration',
			],
		],
	],

	

	//standard roles defined,
	'roles' => [
		'admin' => 2, 
		'staff' => 3, 
		'trainer' => 15,
		'member' => 8
	],
	//Lesson edition statuses
	'lesson_edition_statuses' => [
		'draft' => 1,
		'scheduled' => 2,
		'booked' => 3,
		'completed' => 4,
		'cancelled-staff' => 5,
		'cancelled-athlete'=> 6,
		'accounted' => 7,
	],
	//Activity statuses
	'activity_statuses' => [
		'draft' => 1,
		'scheduled' => 2,
		'completed' => 3,
		'cancelled' => 4,
	],
	//Purchased Lesson Edition Bundles Statuses
	'purchased_lesson_editions_bundle_statuses' => [
		'purchased' => 1,
		'activated' => 2,
		'exhausted' => 3,
		'expired' => 4,
		'revoked' => 5
	],

	'Athletes' => [
		'birthdate_minYear' => 1968,
	],
]
?>