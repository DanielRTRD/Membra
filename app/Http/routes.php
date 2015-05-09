<?php

/*
| DEBUG ONLY
*/
if(Config::get('app.debug')) {
	Route::get('/resetdb', function() {
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		Artisan::call('db:seed');
		return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
	});
}

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::model('user', 'App\User');

Route::group([
    'middleware' => 'auth' ,
    ], function() {
    get('/profile/{user}', [
        'as' => 'profile' ,
        'uses' => 'User\ProfileController@index'
    ]);
});

Route::get('/register', ['as' => 'register', 'uses' => 'User\AuthController@getRegister']);
Route::post('/register', ['as' => 'post.register', 'uses' => 'User\AuthController@postRegister']);
Route::get('/login', ['as' => 'login', 'uses' => 'User\AuthController@getLogin']);
Route::post('/login', ['as' => 'post.login', 'uses' => 'User\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'User\AuthController@getLogout']);