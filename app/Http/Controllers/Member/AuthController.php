<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests\Member\LoginRequest;
use App\Http\Requests\Member\RegisterRequest;

use Illuminate\Support\Facades\Redirect;
use App\User;

class AuthController extends Controller {

	use AuthenticatesAndRegistersUsers;
 
	public function __construct(Guard $auth, Registrar $registrar) {
		$this->auth = $auth;
		$this->registrar = $registrar;
 
		$this->beforeFilter('csrf', ['on' => ['post']]);
		$this->beforeFilter('guest', ['except' => ['getLogout']]);
	}
	 
	public function getLogout() {
		$this->auth->logout();
		return Redirect::route('home')->with('messagetype', 'success')->with('message', 'You have now been successfully been logged out!');
	}

	public function getActivate($activation_code) {
		$user = User::where('activation_code', '=', $activation_code)->where('active', '=', 0)->first();

		if($user != null) {

			//update user to active state
			$user->active 			= 1;
			$user->activation_code 	= '';

			if($user->save()) {
				return Redirect::route('account-login')
						->with('globaltype', 'success')
						->with('global', 'Your account is now active! Please login.');
			}

		}

		return Redirect::route('home')
				->with('globaltype', 'danger')
				->with('global', 'Something went wrong while trying to activate your account.');

	}

}
