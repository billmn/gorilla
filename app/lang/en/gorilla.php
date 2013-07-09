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

	'reminders' => array(
		'user'     => 'Indirizzo email non trovato.',
		'token'    => 'Token per il reset della password non valido.',
		'password' => 'La password deve essere di almeno 6 caratteri e corrispondere al campo di conferma.',
	),

	/*
	|--------------------------------------------------------------------------
	| Install
	|--------------------------------------------------------------------------
	*/
	'install' => array(
		'next' => 'Avanti &raquo;',

		// Checl requirements
		'check' => array(
			'title'    => 'Requisiti',
			'subtitle' => 'Verifica requisiti di sistema',
			'repeat'   => 'Ripeti verifica',

			'requirements' => array(
				'php_version'  => 'Versione PHP',
				'ext_pdo'      => 'PDO',
				'ext_mcrypt'   => 'Mcrypt',
				'ext_fileinfo' => 'Fileinfo',
				'ext_gd'       => 'GD',
			),
		),

		// Step 1
		'step1' => array(
			'title'    => 'Step 1',
			'subtitle' => 'Connessione al database',

			'fields' => array(
				'host'     => 'Host',
				'name'     => 'Nome database',
				'username' => 'Username',
				'password' => 'Password',
			),
		),

		// Step 2
		'step2' => array(
			'title'       => 'Step 2',
			'subtitle'    => 'Configurazione utente Admin',
			'description' => 'Imposta la password per l\'utente amministratore del sito.',

			'fields' => array(
				'username' => 'Username',
				'email'    => 'Email',
				'password' => 'Password',
				'password_confirmation' => 'Ripeti Password',
			),
		),

		// Step 3
		'step3' => array(
			'title'       => 'Congratulazioni !',
			'subtitle'    => 'Installazione completata',
			'description' => 'E\' andato tutto secondo i piani !<br />Ora puoi accedere al pannello e configurare il tuo nuovo sito',
			'go_to_admin' => 'Vai al pannello',
		),
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
				'failed'  => 'Utente o password errati',
				'success' => 'Fatto! Controlla la casella email.',
			),

			'email' => array(
				'title'   => 'Richiesta reset password',
				'subject' => 'Richiesta reset password',
				'body'    => 'Ciao :display_name,<br /> hai richiesto il reset della password dal sito <a href=":domain" target="_blank">:domain</a> ... non preoccuparti, succede anche ai migliori ! ;)<br /><br />Se vuoi procedere al cambio password clicca sul pulsante qui sotto.',
				'btn'     => 'Cambia la password',
			),
		),

		// Reset password
		'reset' => array(
			'title' => 'Reset password',

			'fields' => array(
				'email'                 => 'Inserisci il tuo indirizzo Email',
				'password'              => 'Password',
				'password_confirmation' => 'Conferma Password',
			),

			'actions' => array(
				'login' => 'Torna al Login',
				'reset' => 'Reset password',
			),

			'msg' => array(
				'success' => 'Password aggiornata.',
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

		'empty'     => 'Nessun post inserito',
		'slug_auto' => 'Automatico ...',
		'image'     => 'Seleziona un\'immagine ...',

		'fields' => array(
			'title'        => 'Titolo',
			'slug'         => 'Slug',
			'image'        => 'Immag.',
			'publish_date' => 'Pubblicazione',
			'content'      => 'Contenuto',
			'tags'         => 'Tags',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Tags
	|--------------------------------------------------------------------------
	*/
	'tags' => array(
		'title' => 'Tags',
		'sing'  => 'tag',
		'plur'  => 'tags',

		'empty'       => 'Nessun tag inserito',
		'placeholder' => 'Inserisci i tags ...',

		'fields' => array(
			'name'       => 'Nome',
			'occurrence' => 'Occorrenze',
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Media
	|--------------------------------------------------------------------------
	*/
	'media' => array(
		'title'  => 'Media',
		'sing'   => 'media',
		'plur'   => 'media',
		'upload' => 'Carica files',

		'empty'  => 'Nessun file inserito',

		'fields' => array(

		),
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
			'posts'                 => 'Posts',
		),

		'msg' => array(
			'admin_username_error' => "Lo username dell'utente :username non può essere modificato",
			'admin_disable_error'  => "L'utente :username non può essere disabilitato",
			'admin_delete_error'   => "L'utente :username non può essere eliminato",
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
			'website_footer' => 'Footer Sito',
			'timezone'       => 'Fuso orario',
			'theme'          => 'Tema',
		),
	),

);