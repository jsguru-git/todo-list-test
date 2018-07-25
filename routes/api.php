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

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
	Route::post('auth/register', 'AuthController@register');
	Route::post('auth/login', 'AuthController@login');
	Route::group(['middleware' => 'jwt.auth'], function(){
		Route::get('auth/user', 'AuthController@user');
		Route::post('auth/logout', 'AuthController@logout');
	});
	Route::group(['middleware' => 'jwt.refresh'], function(){
	  	Route::get('auth/refresh', 'AuthController@refresh');
	});
	Route::group(['middleware' => 'jwt.auth'], function(){
		Route::get('tasks', 'TaskController@getAllTasks');
		Route::post('task/store', 'TaskController@store');
		Route::delete('tasks', 'TaskController@deleteAll');
	});
    Route::patch('task/{id}', 'TaskController@update');
    Route::delete('task/{id}', 'TaskController@destroy');
});

