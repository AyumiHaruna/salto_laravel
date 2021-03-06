<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});

Route::post('login', 'API\PassportController@login');

Route::post('register', 'API\PassportController@register');

Route::get('get-session-details/{id}', 'API\PassportController@getSessionDetails');
Route::get('get-session2', 'API\PassportController@getSessionDetails');
Route::get('session-update/{id}/{value}', 'API\PassportController@sessionUpdate');  //coach 0 / cliente 1
Route::get('session-status/{id}', 'API\PassportController@sessionStatus');
Route::get('point-session/{id}/{point}', 'API\PassportController@pointSession');



Route::group(['middleware' => 'auth:api'], function(){
	Route::post('get-details', 'API\PassportController@getDetails');
	Route::get('get-session-list', 'API\PassportController@getSessionList');
});
