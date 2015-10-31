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
Route::get('/tos', ['as' => 'account-tos-privacy', 'uses' => 'HomeController@index']);

/*
| IF IN DEBUG MODE THEN DO NOT USE SUBDOMAIN
*/
if(Config::get('app.debug')) {

	Route::group([
		'middleware' => 'guest',
		'prefix' => 'account',
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
			get('/register', [
				'as' => 'account-register',
				'uses' => 'Member\AuthController@getRegister'
			]);
			post('/register', [
				'as' => 'account-register-post',
				'uses' => 'Member\AuthController@postRegister'
			]);
			get('/login', [
				'as' => 'account-login',
				'uses' => 'Member\AuthController@getLogin'
			]);
			post('/login', [
				'as' => 'account-login-post',
				'uses' => 'Member\AuthController@postLogin'
			]);
	});

	Route::group([
		'middleware' => 'auth',
		'prefix' => 'user',
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
			get('/logout', [
				'as' => 'logout',
				'uses' => 'Member\AuthController@getLogout'
			]);
	});

	// ADMIN PANEL
	Route::group([
		'middleware' => 'auth',
		'prefix' => 'admin',
		], function() {
			/*get('/', [
				'as' => 'account' ,
				'uses' => 'Member\AccountController@index'
			]);*/
	});

/*
| ELSE USE DOMAIN INSTEAD
*/

} else {
	Route::group([
		'middleware' => 'guest',
		'doamin' => 'user.'.Config::get('rtech.appdomain'),
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
			get('/register', [
				'as' => 'account-register',
				'uses' => 'Member\AuthController@getRegister'
			]);
			post('/register', [
				'as' => 'account-register-post',
				'uses' => 'Member\AuthController@postRegister'
			]);
			get('/login', [
				'as' => 'account-login',
				'uses' => 'Member\AuthController@getLogin'
			]);
			post('/login', [
				'as' => 'account-login-post',
				'uses' => 'Member\AuthController@postLogin'
			]);
	});

	Route::group([
		'middleware' => 'auth',
		'domain' => 'user.'.Config::get('rtech.appdomain'),
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
			get('/logout', [
				'as' => 'logout',
				'uses' => 'Member\AuthController@getLogout'
			]);
	});

	// ADMIN PANEL
	Route::group([
		'middleware' => 'auth',
		'domain' => 'admin.'.Config::get('rtech.appdomain'),
		], function() {
			/*get('/', [
				'as' => 'account' ,
				'uses' => 'Member\AccountController@index'
			]);*/
	});
}

Route::get('/user/{username}', ['as' => 'user-profile', 'uses' => 'Member\ProfileController@index']);
Route::get('/members', ['as' => 'members', 'uses' => 'Member\ProfileController@getMembers']);

Route::group(['prefix' => 'ajax',], function() {
	Route::post('/account/register', function () {
		$resp = array();
		$resp['submitted_data'] = Request::all();
		return Response::json($resp);
	});
	Route::post('/account/login', function () {

		$resp = array();
		$login_status = 'invalid';
		$login_msg = 'Something went wrong...';

		$username = Request::input('username');
		$password = Request::input('password');
		$remember = Request::input('remember');

		$user = \App\User::where('username', '=', $username)->first();

		if ($user == null) {

			$login_msg = 'User not found!';

		} else {

			$active = $user->active;

			if ($active == 0) {

				$login_msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif (Auth::attempt(['username' => $username, 'password' => $password, 'active' => 1], $remember)) {

				$login_status = 'success';
				$resp['redirect_url'] = URL::route('account');

			} else {

				$login_msg = 'Username or password was wrong. Please try again.';

			}

		}

		$resp['login_status'] = $login_status;
		$resp['login_msg'] = $login_msg;

		/*
		# Response Data Array
		$resp = array();
		// Fields Submitted
		$username = Request::input("username");
		$password = Request::input("password");

		// This array of data is returned for demo purpose, see assets/js/neon-forgotpassword.js
		$resp['submitted_data'] = Request::all();

		// Login success or invalid login data [success|invalid]
		// Your code will decide if username and password are correct
		$login_status = 'invalid';

		if($username == 'demo' && $password == 'demo')
		{
			$login_status = 'success';
		}

		$resp['login_status'] = $login_status;


		// Login Success URL
		if($login_status == 'success')
		{
			// If you validate the user you may set the user cookies/sessions here
				#setcookie("logged_in", "user_id");
				#$_SESSION["logged_user"] = "user_id";
			
			// Set the redirect url after successful login
			$resp['redirect_url'] = URL::route('account');
		}*/

		return Response::json($resp);
	});
});