<?php

return array(

	'app_name'   => 'Gorilla',
	'app_slogan' => 'a microblogging platform',

	/*
	|--------------------------------------------------------------------------
	| Common
	|--------------------------------------------------------------------------
	*/
	'website_preview' => 'Website Preview',

	'actions' => array(
		'create'  => 'Create',
		'update'  => 'Update',
		'delete'  => 'Delete',
		'logout'  => 'Logout',
		'save'    => 'Save',
		'back'    => 'Back',
	),

	'questions' => array(
		'confirm' => 'Are you sure to proceed ?',
	),

	'messages' => array(
		'confirm' => 'Operation completed successfully',
	),

	'reminders' => array(
		'user'     => 'Email address not found.',
		'token'    => 'This password reset token is invalid.',
		'password' => 'Passwords must be six characters and match the confirmation.',
	),

	/*
	|--------------------------------------------------------------------------
	| Install
	|--------------------------------------------------------------------------
	*/
	'install' => array(
		'next' => 'Next &raquo;',

		// Check requirements
		'check' => array(
			'title'    => 'Requirements',
			'subtitle' => 'Check system requirements',
			'repeat'   => 'Repeat',

			'requirements' => array(
				'php_version'  => 'PHP Version',
				'ext_pdo'      => 'PDO',
				'ext_mcrypt'   => 'Mcrypt',
				'ext_fileinfo' => 'Fileinfo',
				'ext_gd'       => 'GD',
			),
		),

		// Step 1
		'step1' => array(
			'title'    => 'Step 1',
			'subtitle' => 'Database connection',

			'fields' => array(
				'host'     => 'Host',
				'name'     => 'Database name',
				'username' => 'Username',
				'password' => 'Password',
			),
		),

		// Step 2
		'step2' => array(
			'title'       => 'Step 2',
			'subtitle'    => 'Admin user configuration',
			'description' => 'Set password for the administration user.',

			'fields' => array(
				'username' => 'Username',
				'email'    => 'Email',
				'password' => 'Password',
				'password_confirmation' => 'Repeat Password',
			),
		),

		// Step 3
		'step3' => array(
			'title'       => 'Congratulation !',
			'subtitle'    => 'Installation completed',
			'description' => 'Everything went according to plan!<br />Now you can access to the administration panel and configure your new website',
			'go_to_admin' => 'Go to the panel',
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
				'remember' => 'Remember me',
			),

			'actions' => array(
				'login'  => 'Login',
				'forgot' => 'Lost your password?',
			),

			'msg' => array(
				'failed' => 'Wrong username or password',
			),
		),

		// Forgot password
		'forgot' => array(
			'title' => 'Password recovery',

			'fields' => array(
				'email' => 'Insert your e-mail address',
			),

			'actions' => array(
				'login'  => 'Back to login',
				'forgot' => 'Recover password',
			),

			'msg' => array(
				'failed'  => 'Wrong username or password',
				'success' => 'Done! Check your email inbox.',
			),

			'email' => array(
				'title'   => 'Password reset request',
				'subject' => 'Password reset request',
				'body'    => 'Hello <strong>:username</strong>, <br /> you have requested a password reset from <a href=":domain" target="_blank">: domain </ a> ... don\'t worry, it happens to even the best! ;) <br /> <br /> If you want to proceed to the change of password click on the button below.',
				'btn'     => 'Change the password',
			),
		),

		// Reset password
		'reset' => array(
			'title' => 'Password reset',

			'fields' => array(
				'email'                 => 'Insert your email address',
				'password'              => 'Password',
				'password_confirmation' => 'Password confirm',
			),

			'actions' => array(
				'login' => 'Back to login',
				'reset' => 'Reset password',
			),

			'msg' => array(
				'success' => 'Password updated.',
			),
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Dashboard
	|--------------------------------------------------------------------------
	*/
	'home' => array(
		'title' => 'Dashboard',
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

		'empty'     => 'No posts inserted',
		'slug_auto' => 'Automatic ...',
		'image'     => 'Select an image ...',

		'fields' => array(
			'title'        => 'Title',
			'slug'         => 'Slug',
			'image'        => 'Image',
			'publish_date' => 'Publish date',
			'content'      => 'Content',
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

		'empty'       => 'No tags inserted',
		'used_by'     => 'Used by',
		'placeholder' => 'Insert some tags ...',

		'fields' => array(
			'name'       => 'Name',
			'occurrence' => 'Occurrences',
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
		'upload' => 'Upload files',

		'empty'  => 'No files uploaded',

		'fields' => array(

		),
	),

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/
	'users' => array(
		'title' => 'Users',
		'sing'  => 'user',
		'plur'  => 'users',

		'profile' => 'Profile',

		'fields' => array(
			'email'                 => 'Email',
			'username'              => 'Username',
			'password'              => 'Password',
			'password_confirmation' => 'Password confirm',
			'enabled'               => 'Enabled',
			'last_login'            => 'Last login',
			'posts'                 => 'Posts',
		),

		'msg' => array(
			'admin_username_error' => "The username of the user :username cannot be changed",
			'admin_disable_error'  => "The user :username cannot be disabled",
			'admin_delete_error'   => "The user :username cannot be deleted",
		),
	),

	/*
	|--------------------------------------------------------------------------
	| Users
	|--------------------------------------------------------------------------
	*/
	'settings' => array(
		'title' => 'Settings',
		'sing'  => 'settings',
		'plur'  => 'setting',

		'utc_time'   => 'UTC time',
		'local_time' => 'Local time',

		'fields' => array(
			'website_title'  => 'Website title',
			'website_slogan' => 'Website slogan',
			'website_footer' => 'Website footer',
			'timezone'       => 'Timezone',
			'theme'          => 'Theme',
		),
	),

);