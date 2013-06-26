<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
Route::group(array('prefix' => 'admin'), function()
{
	Route::any('login',  array('as' => 'login',  'uses' => 'AdminAuthController@login'));
	Route::get('logout', array('as' => 'logout', 'uses' => 'AdminAuthController@logout'));
	Route::any('forgot', array('as' => 'forgot', 'uses' => 'AdminAuthController@forgot'));
	Route::any('reset',  array('as' => 'reset',  'uses' => 'AdminAuthController@reset'));

	Route::group(array('before' => 'auth'), function()
	{
		// Home
		Route::get('/', array('as' => 'admin_home', 'uses' => 'AdminHomeController@index'));

		// Posts
		Route::get('posts',             array('as' => 'admin_posts',       'uses' => 'AdminPostController@index'));
		Route::any('posts/create',      array('as' => 'admin_post_create', 'uses' => 'AdminPostController@create'));
		Route::any('posts/update/{id}', array('as' => 'admin_post_update', 'uses' => 'AdminPostController@update'));
		Route::get('posts/delete/{id}', array('as' => 'admin_post_delete', 'uses' => 'AdminPostController@delete'));
		Route::any('posts/slug',        array('as' => 'admin_post_slug',   'uses' => 'AdminPostController@slug'));

		// Users
		Route::get('users',             array('as' => 'admin_users',       'uses' => 'AdminUserController@index'));
		Route::any('users/create',      array('as' => 'admin_user_create', 'uses' => 'AdminUserController@create'));
		Route::any('users/update/{id}', array('as' => 'admin_user_update', 'uses' => 'AdminUserController@update'));
		Route::get('users/delete/{id}', array('as' => 'admin_user_delete', 'uses' => 'AdminUserController@delete'));

		// Settings
		Route::any('settings',          array('as' => 'admin_settings',    'uses' => 'AdminSettingsController@index'));
	});

});

app('gorilla.theme')->routes();

Route::any('/',           array('as' => 'home', 'uses' => 'PublicController@home'));
Route::any('rss',         array('as' => 'rss',  'uses' => 'PublicController@rss'));
Route::any('post/{slug}', array('as' => 'post', 'uses' => 'PublicController@post'));