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
	Route::get('/mailtest', function() {
		Mail::send('emails.activate', ['link'=>'derp','firstname'=>'Daniel'], function($message) {
			$message->to("daniel@retardedtech.com", "Daniel")->subject('Test Email');
		});
		if(count(Mail::failures()) > 0) {
			dd('Mail Failure.');
		} else {
			dd('Success.');
		}
	});
}

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('/tos', ['as' => 'account-tos', 'uses' => 'HomeController@index']);
Route::get('/privacy', ['as' => 'account-privacy', 'uses' => 'HomeController@index']);

/*
| IF IN DEBUG MODE THEN DO NOT USE SUBDOMAIN
*/
Route::group([
	'middleware' => 'guest',
	'prefix' => 'account',
	], function() {
		get('/forgot', [
			'as' => 'account-forgot' ,
			'uses' => 'Member\RecoverController@getForgot'
		]);
		post('/forgot', [
			'as' => 'account-forgot-post' ,
			'uses' => 'Member\RecoverController@postForgot'
		]);
		get('/recover/{token}', [
			'as' => 'account-recover' ,
			'uses' => 'Member\RecoverController@getRecoverAccount'
		]);
		post('/recover/{token}', [
			'as' => 'account-recover-post' ,
			'uses' => 'Member\RecoverController@postRecoverAccount'
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
		get('/activate/{activation_code}', [
			'as' => 'account-activate',
			'uses' => 'Member\AuthController@getActivate'
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

Route::get('/user/{username}', ['as' => 'user-profile', 'uses' => 'Member\ProfileController@index']);
Route::get('/members', ['as' => 'members', 'uses' => 'Member\ProfileController@getMembers']);

Route::group(['prefix' => 'ajax',], function() {
	Route::post('/account/register', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();

		$reg_status = 'invalid';
		$reg_msg = 'Something went wrong...';

		$email 				= Request::get('email');
		$firstname	 		= Request::get('firstname');
		$lastname 			= Request::get('lastname');
		$username 			= Request::get('username');
		$password 			= Request::get('password');

		$originalDate 		= Request::input('birthdate');
		$birthdate 			= date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

		$referral			= Request::get('referral');
		$referral_code 		= str_random(15);
		$activation_code	= str_random(60); // Activation Code

		$user = \App\User::create(array(
			'email' 			=> $email,
			'username'			=> $username,
			'firstname'			=> $firstname,
			'lastname'			=> $lastname,
			'birthdate'			=> $birthdate,
			'password'			=> $password,
			'activation_code'	=> $activation_code,
			'referral'			=> $referral,
			'referral_code'		=> $referral_code,
			'active'			=> 0
		));

		if($user) {

			$reg_status = 'success';

			Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $activation_code), 'firstname' => $firstname), function($message) use ($user) {
				$message->to($user->email, $user->firstname)->subject('Activate your account');
			});

			if(count(Mail::failures()) > 0) {
				$reg_status = 'invalid';
				$reg_msg = 'Something went wrong while trying to send you an email.';
			}

			Session::forget('referral'); //forget the referral

			/*return Redirect::route('home')
					->with('messagetype', 'success')
					->with('message', 'Your account has been created! We have sent you an email to acitvate your account.');*/

		} else {
			$reg_status = 'invalid';
			$reg_msg = 'Something went wrong while trying to register your user.';
		}

		
		$resp['reg_status'] = $reg_status;
		$resp['reg_msg'] = $reg_msg;
		return Response::json($resp);
	});
	Route::post('/account/login', function () {

		if(!Request::ajax()) {
			abort(403);
		}

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

		return Response::json($resp);
	});
	Route::post('/account/forgot', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();
		$forgot_status = 'invalid';
		$forgot_msg = 'Something went wrong...';

		$email = Request::input('email');
		$originalDate = Request::input('birthdate');
		$birthdate = date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution

		$user = \App\User::where('email', '=', $email)->first();

		if ($user == null) {

			$forgot_msg = 'User not found!';

		} else {

			$active = $user->active;

			if ($active == 0) {

				$forgot_msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif ($birthdate == $user->birthdate) {

				$passwordtoken 			= str_random(60);
				$password_temp 			= str_random(16);

				$user->passwordtoken 	= $passwordtoken;
				$user->password_temp	= $password_temp;

				if($user->save()) {

					Mail::send('emails.auth.forgot', 
						array(
							'link' => URL::route('account-recover', $passwordtoken),
							'firstname' => $user->firstname,
							'username' => $user->username,
							'password_temp' => $password_temp
						), function($message) use ($user) {
							$message->to($user->email, $user->firstname)->subject('Account Recovery');
					});
					
					if(count(Mail::failures()) > 0) {
						$forgot_msg = 'Mail Failure.';
					} else {
						$forgot_status = 'success';
						$forgot_msg = 'Everything went well.';
					}

				} else {
					$forgot_msg = 'Could not save the user changes. Please contact the staff.';
				}

			} else {

				$forgot_msg = 'E-mail or birthdate was wrong. Please try again.';

			}

		}

		$resp['forgot_status'] 	= $forgot_status;
		$resp['forgot_msg'] 	= $forgot_msg;

		return Response::json($resp);
	});
	Route::post('/account/recover', function () {

		if(!Request::ajax()) {
			abort(403);
		}

		$resp = array();
		$recover_status = 'invalid';
		$recover_msg = 'Something went wrong...';

		$passwordtoken 		= Request::input('passwordtoken');
		$email 				= Request::input('email');
		$originalDate 		= Request::input('birthdate');
		$birthdate 			= date_format(date_create_from_format('d/m/Y', $originalDate), 'Y-m-d'); //strtotime fucks the date up so this is the solution
		$password 			= Request::input('password');

		$user = \App\User::where('email', '=', $email)->first();

		if ($user == null) {

			$recover_msg = 'User not found!';

		} else {

			$active = $user->active;

			if ($active == 0) {

				$recover_msg = '<strong>Your user is not active!</strong><br>Please check your inbox for the activation email.';

			} elseif ($birthdate == $user->birthdate && $passwordtoken == $user->passwordtoken) {

				$user->passwordtoken 	= '';
				$user->password_temp	= '';
				$user->password			= $password;

				if($user->save()) {

					$recover_status = 'success';
					$recover_msg = 'Everything went well.';

				} else {
					$recover_msg = 'Could not save the user changes. Please contact the staff.';
				}

			} else {

				$recover_msg = 'E-mail, recoverytoken or birthdate was wrong. Please try again.';

			}

		}

		$resp['recover_status'] 	= $recover_status;
		$resp['recover_msg'] 		= $recover_msg;

		return Response::json($resp);
	});
});