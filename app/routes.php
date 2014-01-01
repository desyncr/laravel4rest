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

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('users', function()
{
	return 'Users route';
});

Route::get('tasks', 'TasksController@getIndex');

Route::group(array('prefix' => 'api/v1', 'before' => 'auth.basic'), function()
{
	Route::resource('task', 'TasksController');
});

Route::get('/authtest', array('before' => 'auth.basic', function()
{
	return 'Auth';
}));


