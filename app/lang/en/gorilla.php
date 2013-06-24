<?php

return array(

	'app_name'   => 'Gorilla',
	'app_slogan' => 'microblogging platform',

	'auth' => array(

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

);