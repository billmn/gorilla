<?php

return array(

	'app_name'   => 'Gorilla',
	'app_slogan' => 'a microblogging platform',

	/*
	|--------------------------------------------------------------------------
	| Common
	|--------------------------------------------------------------------------
	*/
	'website_preview' => 'Anteprima Sito',

	'actions' => array(
		'create'  => 'Crea',
		'update'  => 'Modifica',
		'delete'  => 'Elimina',
		'logout'  => 'Logout',
		'save'    => 'Salva',
		'back'    => 'Torna indietro',
	),

	'questions' => array(
		'confirm' => 'Sei sicuro di voler procedere ?',
	),

	'messages' => array(
		'confirm' => 'Operazione completata con successo',
	),

	/*
	|--------------------------------------------------------------------------
	| Authentication
	|--------------------------------------------------------------------------
	*/
	'auth' => array(
		// Login
		'login' => array(
			'title' => 'Login',

			'fields' => array(
				'username' => 'Username',
				'password' => 'Password',
				'remember' => 'Ricordami',
			),

			'actions' => array(
				'login'  => 'Accedi',
				'forgot' => 'Hai perso la password ?',
			),

			'msg' => array(
				'failed' => 'Utente o password errati',
			),
		),

		// Forgot password
		'forgot' => array(
			'title' => 'Recupero password',

			'fields' => array(
				'email' => 'Inserisci il tuo indirizzo Email',
			),

			'actions' => array(
				'login'  => 'Torna al Login',
				'forgot' => 'Recupera password',
			),

			'msg' => array(
				'failed' => 'Utente o password errati',
			),
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Posts
	|--------------------------------------------------------------------------
	*/
	'posts' => array(
		'title' => 'Posts',
		'sing'  => 'post',
		'plur'  => 'posts',
	),

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/
	'users' => array(
		'title' => 'Utenti',
		'sing'  => 'utente',
		'plur'  => 'utenti',

		'fields' => array(
			'email'                 => 'Email',
			'username'              => 'Username',
			'password'              => 'Password',
			'password_confirmation' => 'Conferma Password',
			'enabled'               => 'Abilitato',
			'last_login'            => 'Ultimo accesso',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/
	'settings' => array(
		'title' => 'Impostazioni',
		'sing'  => 'impostazioni',
		'plur'  => 'impostazione',

		'utc_time'   => 'Orario UTC',
		'local_time' => 'Orario Locale',

		'fields' => array(
			'website_title'  => 'Titolo Sito',
			'website_slogan' => 'Slogan Sito',
			'timezone'       => 'Fuso orario',
		),
	),

);