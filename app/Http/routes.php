<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|	
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => 'web'], function () {
	
    Route::auth();
    Route::get('dash', 'DashController@index');
    Route::get('meds', 'MedsController@index');
	Route::get('meds/{med}', 'MedsController@show');
	Route::get('meds/add', 'MedsController@add'); // form to fill and add med
	Route::get('meds/{med}/edit', 'MedsController@edit'); // form to fill and add med
	Route::post('meds', 'MedsController@store');
	Route::patch('meds/{med}', 'MedsController@update'); 
	Route::delete('meds/{med}', 'MedsController@delete'); 


});
