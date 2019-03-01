<?php
return [
	//layout used for private area
	'private-layout' => 'private',

	//main navigation
	
	'main_nav' => [

		//controllers are grouped by area
		'controllers' => [
			//pages belongs to Home area
			'Pages' => [
				'topic' => 'Home',
			],
			//events belongs to Events area
			'Events' => [
				'topic' => 'Events',
			],
			//users and roles belong to UsersManagement area
			'Users' => [
				'topic' => 'UsersManagement',
			],
			'Roles' => [
				'topic' => 'UsersManagement',
			],
			//Athletes and Responsible Persons belong to AthletesManagement area
			'Athletes' => [
				'topic' => 'AthletesManagement',
			],
			'ResponsiblePersons' => [
				'topic' => 'AthletesManagement',
			],
			//Lessons, LessonsEditions, LessonsEditionsBundles and PurchasedLessonsEditionBundles belong to LessonsManagement Area
			'Lessons' => [
				'topic' => 'LessonsManagement',
			], 
			'LessonEditions' => [
				'topic' => 'LessonsManagement',
			],
			'LessonEditionsBundles' => [
				'topic' => 'LessonsManagement',
			],
			'PurchasedLessonEditionsBundles' => [
				'topic' => 'LessonsManagement',
			],
			//Activities belongs to ActivitiesManagement Area
			'Activities' => [
				'topic' => 'ActivitiesManagement'
			]
		],

		'topics' => [
			'Pages' => [

			],
			'Events' => [

			],
			'UsersManagement' => [

			],
			'AthletesManagement' => [

			],
			'LessonsManagement' => [

			],
			'ActivitiesManagement' => [

			],
		] 
	],



	//standard roles defined,
	'roles' => [
		'admin' => 2, 
		'staff' => 3, 
		'trainer' => 15,
		'member' => 8
	],
	'lesson_edition_statuses' => [
		'draft' => 1,
		'scheduled' => 2,
		'booked' => 3,
		'completed' => 4,
		'cancelled-staff' => 5,
		'cancelled-athlete'=> 6,
		'accounted' => 7,
	],
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