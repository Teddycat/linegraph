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

Route::get('/graph', 'GraphController@index');
Route::get('/graph/{what}/{where}', 'GraphController@search');
Route::get('/graph/{what?}/{where?}/sort/{column}/{direction}', 'GraphController@sortWithParams');
Route::get('/graph/sort/{column}/{direction}', 'GraphController@sort');
Route::post('/graph/handle', 'GraphController@handleOrder');