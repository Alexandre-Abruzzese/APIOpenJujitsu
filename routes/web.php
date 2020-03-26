<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
use \Illuminate\Support\Facades\Route;
//'middleware' => 'auth', (before the 'as').

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('account', ['as' => 'account', 'uses' => 'UserController@getAccountInformations']);

});

Route::post('logout', ['as' => 'logout', 'uses' => 'ConnexionController@logout']);
Route::post('register', ['as' => 'register', 'uses' => 'ConnexionController@register']);
Route::post('login', ['as' => 'login', 'uses' => 'ConnexionController@login']);
