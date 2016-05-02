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
Route::get('/', 'HomeController@about');
Route::get('home', 'HomeController@home');
Route::get('about', 'HomeController@about');
Route::get('json/meds', 'JsonController@allMeds');
Route::get('json/types', 'JsonController@allTypes');
Route::get('json/type/add', 'JsonController@addType');
Route::get('json/search/{med_name}', 'JsonController@searchMed');
Route::get('json/med/add', 'JsonController@addMed');
Route::get('medbot', 'BotController@bot');
Route::get('medbot/callback', 'BotController@callback');


/*
|--------------------------------------------------------------------------
| Application Routes
|---------------------- ----------------------------------------------------
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
	Route::get('meds/{med}/edit', 'MedsController@edit'); 
	Route::post('meds', 'MedsController@store');
	Route::patch('meds/{med}', 'MedsController@update'); 
	Route::delete('meds/{med}', 'MedsController@delete'); 
	Route::post('meds/newtype', 'MedsController@newType'); 
	Route::post('meds/newuse', 'MedsController@newUse'); 
	Route::get('uses', 'MedsController@uses'); 
    Route::get('friends', 'FriendsController@index')->name('friends');
    Route::get('friend/{friend}', 'FriendsController@show');
    Route::get('friend/{friend}/add', 'FriendsController@addFriend');
	Route::get('search', 'SearchController@results');

	Route::get('mymeds', 'MyMedsController@index');
	Route::get('plus/{mymed}', 'MyMedsController@plus'); 
	Route::get('minus/{mymed}', 'MyMedsController@minus'); 
	Route::get('meds/{med}/add', 'MyMedsController@addMyMeds'); 
	Route::post('meds/{med}', 'MyMedsController@storeMyMeds'); 



});
