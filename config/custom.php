<?php
return [
	//layout used for private area
	'private-layout' => 'private',

	//main navigation
	//controllers are grouped by area
	'main_nav' => [
		//pages belongs to Home area
		'Pages' => [
			'area' => 'Home',
		],
		//events belongs to Events area
		'Events' => [
			'area' => 'Events',
		],
		//users and roles belong to UsersManagement area
		'Users' => [
			'area' => 'UsersManagement',
		],
		'Roles' => [
			'area' => 'UsersManagement',
		],
		//Athletes and Responsible Persons belong to AthletesManagement area
		'Athletes' => [
			'area' => 'AthletesManagement',
		],
		'ResponsiblePersons' => [
			'area' => 'AthletesManagement',
		],
		//Lessons, LessonsEditions, LessonsEditionsBundles and PurchasedLessonsEditionBundles belong to LessonsManagement Area
		'Lessons' => [
			'area' => 'LessonsManagement',
		], 
		'LessonEditions' => [
			'area' => 'LessonsManagement',
		],
		'LessonEditionsBundles' => [
			'area' => 'LessonsManagement',
		],
		'PurchasedLessonEditionsBundles' => [
			'area' => 'LessonsManagement',
		],
		//Activities belongs to ActivitiesManagement Area
		'Activities' => [
			'area' => 'ActivitiesManagement'
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
	'Athletes' => [
		'birthdate_minYear' => 1968,
	],

]

?>