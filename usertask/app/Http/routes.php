<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Display All Tasks
 */
Route::get('tasks', 'TaskController@index');

/**
 * Add A New Task
 */
Route::post('task', 'TaskController@save');

/**
 * Delete An Existing Task
 */
Route::delete('task/{task}', 'TaskController@delete');


Route::auth();

Route::get('/home', 'HomeController@index');
