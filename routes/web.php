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

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('account', ['as' => 'account', 'uses' => 'UserController@getAccountInformations']);

    Route::post('logout', ['as' => 'logout', 'uses' => 'ConnexionController@logout']);
    Route::post('add-event', ['as' => 'add-event', 'uses' => 'EventController@addAnEvent']);
    Route::post('add-user', ['as' => 'add-user', 'uses' => 'ConnexionController@register']);

    Route::put('update-event', ['as' => 'update-event', 'uses' => 'EventController@modifyOneEvent']);
    Route::put('delete-event', ['as' => 'delete-event', 'uses' => 'EventController@dropOneEvent']);
    Route::put('update-user', ['as' => 'update-user', 'uses' => 'UserController@updateActiveUser']);
});

Route::get('last-medias', ['as' => 'last-medias', 'uses' => 'MediaController@getLastMedias']);
Route::get('medias', ['as' => 'medias', 'uses' => 'MediaController@getAllMedias']);

Route::get('news', ['as' => 'news', 'uses' => 'NewController@getNews']);

Route::get('events', ['as' => 'events', 'uses' => 'EventController@getAllEvents']);
Route::put('event', ['as' => 'event', 'uses' => 'EventController@getOneEvent']);

Route::post('register', ['as' => 'register', 'uses' => 'ConnexionController@register']);
Route::post('login', ['as' => 'login', 'uses' => 'ConnexionController@login']);
