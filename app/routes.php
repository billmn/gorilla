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
		Route::get('/', function() { return View::make('admin/base'); });
	});

});

Route::get('/', function()
{
	return View::make('hello');
});