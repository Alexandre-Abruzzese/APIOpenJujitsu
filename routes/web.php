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
    Route::post('media', ['as' => 'add-media', 'uses' => 'MediaController@addAMedia']);
    Route::post('add-user', ['as' => 'add-user', 'uses' => 'ConnexionController@register']);
    Route::post('add-session', ['as' => 'add-session', 'uses' => 'ScheduleController@addASession']);

    Route::put('update-event', ['as' => 'update-event', 'uses' => 'EventController@modifyOneEvent']);
    Route::put('delete-event', ['as' => 'delete-event', 'uses' => 'EventController@dropOneEvent']);
    Route::put('update-user', ['as' => 'update-user', 'uses' => 'UserController@updateActiveUser']);
    Route::put('delete-session', ['as' => 'delete-session', 'uses' => 'ScheduleController@dropOneSession']);
    Route::put('update-session', ['as' => 'update-session', 'uses' => 'ScheduleController@modifyOneSession']);
});

Route::get('last-medias', ['as' => 'last-medias', 'uses' => 'MediaController@getLastMedias']);
Route::get('medias', ['as' => 'medias', 'uses' => 'MediaController@getAllMedias']);
Route::get('media', ['as' => 'media', 'uses' => 'MediaController@getOneMedia']);

Route::get('news', ['as' => 'news', 'uses' => 'NewController@getNews']);

Route::get('events', ['as' => 'events', 'uses' => 'EventController@getAllEvents']);
Route::put('event', ['as' => 'event', 'uses' => 'EventController@getOneEvent']);

Route::get('sessions', ['as' => 'sessions', 'uses' => 'ScheduleController@getAllSessions']);
Route::get('session', ['as' => 'session', 'uses' => 'ScheduleController@getOneSession']);

Route::post('contact', ['as' => 'contactPost', 'uses' => 'ContactController@add']);
Route::get('contacts', ['as' => 'contacts', 'uses' => 'ContactController@getAllContacts']);

Route::post('register', ['as' => 'register', 'uses' => 'ConnexionController@register']);
Route::post('login', ['as' => 'login', 'uses' => 'ConnexionController@login']);
