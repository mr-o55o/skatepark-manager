<?php
return [

	'application_data' => [
		'name' => 'Skatepark Manager',
		'version' => '1.0',
	],

	'company_data' => [
		'name' => 'ASD Enjoy More',
		'registered_office' => [
			'address' => 'Via Maria Bice Valori 5',
			'postal_code' => '00167',
			'city' => 'Roma',
			'province' => 'RM',
			'state' => 'Italia'
		],
		'email' => 'info@bunkerskatepark.org',
		'phone' => '+39 06 59 494 498',
	],

	'skatepark_data' => [
		'name' => 'Bunker Skatepark',
		'location' => [
			'address' => 'Via Maria Bice Valori 5',
			'postal_code' => '00167',
			'city' => 'Roma',
			'province' => 'RM',
			'state' => 'Italia'
		],
		'email' => 'info@bunkerskatepark.org',
		'phone' => '345 69 45 454'
	],

	//standard roles defined,
	'roles' => [
		'admin' => 2,
		'manager' => 16,
		'staff' => 3, 
		'trainer' => 15,
		'member' => 8
	],
	//Lesson edition statuses
	'lesson_edition_statuses' => [
		'draft' => 1,
		'trainer-assigned' => 2,
		'booked' => 3,
		'completed' => 4,
		'cancelled-staff' => 5,
		'cancelled-athlete'=> 6,
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

	//Course statuses
	'course_statuses' => [
		'draft' => 1,
		'scheduled' => 2,
		'active' => 3,
		'completed' => 4,
		'cancelled' => 5
	],

	//Course session statuses
	'course_session_statuses' => [
		'scheduled' => 1,
		'completed' => 2,
		'cancelled' => 3
	],

	'course_class_statuses' => [
		'scheduled' => 1,
		'completed' => 2,
		'cancelled' => 3,
	],

	'Athletes' => [
		'birthdate_minYear' => 1968,
	],

	//layout used for private area
	'private-layout' => 'private',

	//main navigation
	'topics' => [
		'Home' => [
			'name' => 'Home',
			'home' => ['controller' => 'Pages', 'action' => 'display'],
		],

		'Monitoring' => [
			'name' => 'Monitoraggio',
			'home' => ['controller' => 'Monitoring', 'action' => 'index'],
		],

		'Events' => [
			'name' => 'Eventi',
			'home' => ['controller' => 'Events', 'action' => 'calendar'],
		],

		'StaffManagement' => [
			'name' => 'Gestione Staff',
			'home' => ['controller' => 'Users', 'action' => 'indexStaff'],
		],

		'AthletesManagement' => [
			'name' => 'Gestione Atleti',
			'home' => ['controller' => 'Athletes', 'action' => 'index'],
		],

		'LessonsManagement' => [
			'name' => 'Gestione Lezioni Individuali',
			'home' => ['controller' => 'LessonEditions', 'action' => 'indexBooked'],
		],

		'ActivitiesManagement' => [
			'name' => 'Gestione Attività',
			'home' => ['controller' => 'Activities', 'action' => 'indexScheduled'],
		],

		'CoursesManagement' => [
			'name' => 'Gestione Corsi',
			'home' => ['controller' => 'Courses', 'action' => 'index'],
		],
	],

	'main_nav' => [
		
		'Pages' => [
			'display' => [
				'name' => 'Centro di Controllo',
				'topic' => 'Home',
			],
		],

		'Monitoring' => [
			'index' => [
				'name' => 'Dashboard di Lavoro',
				'topic' => 'Monitoring'
			],
		],

		'Users' => [
			'indexStaff' => [
				'name' => 'Elenco Staff',
				'topic' => 'StaffManagement',
			],
			'indexStaffInactive' => [
				'name' => 'Elenco Staff non attivo',
				'topic' => 'StaffManagement',
			],
				'add' => [
					'name' => 'Aggiungi Staff',
					'topic' => 'StaffManagement',
			],
				'view' => [
					'name' => 'Visualizza utente',
					'topic' => 'StaffManagement',
			],
				'edit' => [
					'name' => 'Modifica utente',
					'topic' => 'StaffManagement',
			],
		],

		'UsersAvailability' => [
			'calendar' => [
				'name' => 'Calendario disponibilità',
				'topic' => 'StaffManagement'
			],
			'add' => [
				'name' => 'Aggiungi disponibilità giornaliera',
				'topic' => 'StaffManagement'
			],
			'addMultiple' => [
				'name' => 'Aggiungi disponibilità nel periodo',
				'topic' => 'StaffManagement'
			],
			'day' => [
				'name' => 'Disponibilità nel giorno',
				'topic' => 'StaffManagement'
			],
		],
	
		'Roles' => [
			'index' => [
				'name' => 'Elenco ruoli',
				'topic' => 'StaffManagement',
			],
			'view' => [
				'name' => 'Visualizza ruolo',
				'topic' => 'StaffManagement',
			],

		],
	
		'Athletes' => [
			'index' => [
				'name' => 'Elenco atleti',
				'topic' => 'AthletesManagement',
			],
			'indexActive' => [
				'name' => 'Elenco atleti attivi',
				'topic' => 'AthletesManagement',
			],			
			'indexExpired' => [
				'name' => 'Elenco atleti con iscrizione ASI scaduta',
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
			'manageSubscriptions' => [
				'name' => 'Gestione iscrizioni alle federazioni',
				'topic' => 'AthletesManagement',
			],			
		],

		'AthletesNotes' => [
			'add' => [
				'name' => 'Aggiungi appunto per atleta',
				'topic' => 'AthletesManagement'
			]
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
			'lessonEditionsCalendar' => [
				'name' => 'Calendario delle Lezioni Individuali',
				'topic' => 'Events',
			],
			'activitiesCalendar' => [
				'name' => 'Calendario delle Attività',
				'topic' => 'Events',
			],
			'courseSessionsCalendar' => [
				'name' => 'Calendario dei Corsi',
				'topic' => 'Events',
			],
			'day' => [
				'name' => 'Visualizza giornata',
				'topic' => 'Events',
			],
			'currentWeek' => [
				'name' => 'Visualizza settimana corrente',
				'topic' => 'Events',
			],
		],		

		'Activities' => [
			'index' => [
				'name' => 'Elenco attività',
				'topic' => 'ActivitiesManagement',
			],	
			'indexScheduled' => [
				'name' => 'Elenco attività in programma',
				'topic' => 'ActivitiesManagement',
			],
			'add' => [
				'name' => 'Aggiungi una nuova attività',
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
			'changeUser' => [
				'name' => 'Cambia Responsabile',
				'topic' => 'ActivitiesManagement'
			],
			'complete' => [
				'name' => 'Completa attività',
				'topic' => 'ActivitiesManagement',
			]
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

		'ActivityUsers' => [
			'add' => [
				'name' => 'Assegna Utente ad Attività',
				'topic' => 'ActivitiesManagement'
			] 
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
			'indexForAthlete' => [
				'name' => 'Elenco lezioni per atleta',
				'topic' => 'LessonsManagement',
			],			
			'indexBooked' => [
				'name' => 'Elenco Lezioni prenotate',
				'topic' => 'LessonsManagement',
			],
			'indexTrainerAssigned' => [
				'name' => 'Elenco Lezioni con istruttore assegnato',
				'topic' => 'LessonsManagement',
			],
			'indexDraft' => [
				'name' => 'Elenco Lezioni in bozza',
				'topic' => 'LessonsManagement',
			],
			'indexCompleted' => [
				'name' => 'Elenco Lezioni completate',
				'topic' => 'LessonsManagement',
			],
			'indexCancelled' => [
				'name' => 'Elenco Annullate',
				'topic' => 'LessonsManagement',
			],		
			'add' => [
				'name' => 'Aggiungi nuova lezione',
				'topic' => 'LessonsManagement',
			],
			'addBooked' => [
				'name' => 'Prenota una lezione individuale',
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
				'topic' => 'LessonsManagement',
			],
			'wizard' => [
				'name' => 'Wizard',
				'topic' => 'LessonsManagement',
			],
			'changeTrainer' => [
				'name' => 'Aggiiungi/Cambia istruttore',
				'topic' => 'LessonsManagement',
			],
			'bookForAthlete' => [
				'name' => 'Prenota edizione per atleta',
				'topic' => 'LessonsManagement',
			],
			'book' => [
				'name' => 'Prenota edizione',
				'topic' => 'LessonsManagement',
			],
			'manageEquipRental' => [
				'name' => 'Noleggio attrezzatura',
				'topic' => 'LessonsManagement',
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

		'Courses' => [
			'index' => [
				'name' => 'Corsi',
				'topic' => 'CoursesManagement'
			],
			'indexDraft' => [
				'name' => 'Corsi in bozza',
				'topic' => 'CoursesManagement'
			],
			'indexScheduled' => [
				'name' => 'Corsi pianificati',
				'topic' => 'CoursesManagement'
			],
			'indexActive' => [
				'name' => 'Corsi attivi',
				'topic' => 'CoursesManagement'
			],
			'indexCompleted' => [
				'name' => 'Corsi completati',
				'topic' => 'CoursesManagement'
			],
			'indexCancelled' => [
				'name' => 'Corsi cancellati',
				'topic' => 'CoursesManagement'
			],
			'add' => [
				'name' => 'Aggiungi nuovo Corso',
				'topic' => 'CoursesManagement'
			],
			'view' => [
				'name' => 'Visualizza Corso',
				'topic' => 'CoursesManagement'
			],
			'edit' => [
				'name' => 'Modifica Corso',
				'topic' => 'CoursesManagement'
			],
			'schedule' => [
				'name' => 'Pianifica Corso',
				'topic' => 'CoursesManagement'
			],
			'complete' => [
				'name' => 'Completa Corso',
				'topic' => 'CoursesManagement'
			],			
		],

		'CoursePeriods' => [
			'index' => [
				'name' => 'Periodi dei Corsi',
				'topic' => 'CoursesManagement'
			],	
			'add' => [
				'name' => 'Aggiungi Nuovo Periodo dei Corsi',
				'topic' => 'CoursesManagement'
			],			
		],

		'CourseClasses' => [
			'index' => [
				'name' => 'Elenco Classi',
				'topic' => 'CoursesManagement',
			],		
			'add' => [
				'name' => 'Aggiungi Classe',
				'topic' => 'CoursesManagement',
			],
			'addClasses' => [
				'name' => 'Creazione Classi per Periodo Attivo',
				'topic' => 'CoursesManagement',
			],
		],

		'CourseSessions' => [
			'view' => [
				'name' => 'Visualizza Sessione Corso',
				'topic' => 'CoursesManagement',
			],
			'addTrainer' => [
				'name' => 'Aggiungi Istruttore alla Sessione',
				'topic' => 'CoursesManagement',
			],
			'delete' => [
				'name' => 'Elimina Sessione Corso',
				'topic' => 'CoursesManagement',
			],
			'add' => [
				'name' => 'Aggiungi Sessione Corso',
				'topic' => 'CoursesManagement',
			],
		],

		'CourseSubscriptions' => [
			'index' => [
				'name' => 'Visualizza Iscrizioni Corso',
				'topic' => 'CoursesManagement',
			],
			'indexValidForActiveCoursePeriod' => [
				'name' => 'Visualizza Iscrizioni Corso valide per il Periodo Corsi Attivo',
				'topic' => 'CoursesManagement',
			],
			'subscribeCourse' => [
				'name' => 'Iscrizione Atleta a Corso',
				'topic' => 'CoursesManagement'
			],
			'view' => [
				'name' => 'Visualizza Abbonamento',
				'topic' => 'CoursesManagement'
			],
		],

		'CourseSubscriptionTypes' => [
			'index' => [
				'name' => 'Tipi di Abbonamento Corsi',
				'topic' => 'CoursesManagement',
			],
			'view' => [
				'name' => 'Visualizza Tipo Abbonamento Corsi',
				'topic' => 'CoursesManagement'
			],
		],

		'CourseSessionTrainers' => [
			'addTrainer' => [ 
				'name' => 'Aggiungi istruttore a sessione corso',
				'topic' => 'CoursesManagement'
			]
		],

		'CourseSessionPartecipants' => [
			'add' => [ 
				'name' => 'Aggiungi Partecipanti alla Sessione del Corso',
				'topic' => 'CoursesManagement'
			],
			'view' => [
				'name' => 'Visualizza Registro',
				'topic' => 'CoursesManagement'
			],
			'edit' => [
				'name' => 'Gestione Registro',
				'topic' => 'CoursesManagement'
			],
		],

		'Administration' => [
			'index' => [
				'name' => 'Area di Amministrazione',
				'topic' => 'Administration',
			],
		],
	],
]
?>