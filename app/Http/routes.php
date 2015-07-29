<?php

/*
| DEBUG ONLY
*/
if(Config::get('app.debug')) {
	Route::get('/resetdb', function() {
		Artisan::call('migrate:reset');
		Artisan::call('migrate');
		#Artisan::call('migrate --package=vendor/regulus/activity-log');
		Artisan::call('db:seed');
		return Redirect::to('/')->with('messagetype', 'success')->with('message', 'The database has been reset!');
	});
}

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

Route::model('user', 'App\User');

/*Route::group([
	'middleware' => 'auth' ,
	], function() {
	get('/profile/{user}', [
		'as' => 'profile' ,
		'uses' => 'Member\ProfileController@index'
	]);
});*/

Route::get('/user/{username}', ['as' => 'user-profile', 'uses' => 'Member\ProfileController@index']);

Route::get('/register', ['as' => 'register', 'uses' => 'Member\AuthController@getRegister']);
Route::post('/register', ['as' => 'post.register', 'uses' => 'Member\AuthController@postRegister']);
Route::get('/login', ['as' => 'login', 'uses' => 'Member\AuthController@getLogin']);
Route::post('/login', ['as' => 'post.login', 'uses' => 'Member\AuthController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'Member\AuthController@getLogout']);

Route::group([
	'middleware' => 'auth',
	'prefix' => '/account',
	], function() {
		get('/', [
			'as' => 'account' ,
			'uses' => 'Member\AccountController@index'
		]);
		get('/settings', [
			'as' => 'account-settings' ,
			'uses' => 'Member\AccountController@getSettings'
		]);
		post('/settings', [
			'as' => 'account-settings-post' ,
			'uses' => 'Member\AccountController@postSettings'
		]);
		get('/change/password', [
			'as' => 'account-change-password' ,
			'uses' => 'Member\AccountController@getChangePassword'
		]);
		post('/change/password', [
			'as' => 'account-change-password-post' ,
			'uses' => 'Member\AccountController@postChangePassword'
		]);
		get('/change/details', [
			'as' => 'account-change-details' ,
			'uses' => 'Member\AccountController@getChangeDetails'
		]);
		post('/change/details', [
			'as' => 'account-change-details-post' ,
			'uses' => 'Member\AccountController@postChangeDetails'
		]);
		get('/change/images', [
			'as' => 'account-change-images' ,
			'uses' => 'Member\AccountController@getChangeImages'
		]);
		post('/change/images/profile', [
			'as' => 'account-change-image-profile-post' ,
			'uses' => 'Member\AccountController@postChangeProfileImage'
		]);
		post('/change/images/cover', [
			'as' => 'account-change-image-cover-post' ,
			'uses' => 'Member\AccountController@postChangeProfileCover'
		]);
});

Route::group([
	'middleware' => 'guest',
	'prefix' => '/account',
	], function() {
		get('/forgotpassword', [
			'as' => 'account-forgotpassword' ,
			'uses' => 'Member\PasswordController@getForgotPassword'
		]);
		post('/forgotpassword', [
			'as' => 'account-forgotpassword-post' ,
			'uses' => 'Member\PasswordController@postForgotPassword'
		]);
		get('/recover/{token}', [
			'as' => 'account-recover' ,
			'uses' => 'Member\PasswordController@getRecoverAccount'
		]);
		post('/recover/{token}', [
			'as' => 'account-recover-post' ,
			'uses' => 'Member\PasswordController@postRecoverAccount'
		]);
});