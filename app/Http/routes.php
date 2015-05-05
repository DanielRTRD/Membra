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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
/*
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
*/

Route::model('user', 'App\User');

Route::group( [
    'middleware' => 'auth' ,
        ] , function() {
   
    get( '/profile/{user}' , [
        'as' => 'profile' ,
        'uses' => 'ProfileController@index'
    ] );
} );

Route::get( '/register' , [
    'as' => 'register' ,
    'uses' => 'Auth\AuthController@getRegister'
] );
   
Route::post( '/register' , [
    'as' => 'post.register' ,
    'uses' => 'Auth\AuthController@postRegister'
] );
   
Route::get( '/login' , [
    'as' => 'login' ,
    'uses' => 'Auth\AuthController@getLogin'
] );
   
Route::post( '/login' , [
    'as' => 'post.login' ,
    'uses' => 'Auth\AuthController@postLogin'
] );
   
Route::get( '/logout' , [
    'as' => 'logout' ,
    'uses' => 'Auth\AuthController@getLogout'
] );