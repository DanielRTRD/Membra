<?php

namespace Membra\Http\Controllers\Member;

use Membra\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use Membra\Http\Requests\Member\LoginRequest;
use Membra\Http\Requests\Member\RegisterRequest;

use Illuminate\Support\Facades\Redirect;
use Membra\User;

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
		$user = User::where('activation_code', '=', $activation_code)->first();

		// SOMETHING IS FUCKY HERE

		if($user == null) {
			return Redirect::route('home')
					->with('globaltype', 'error')
					->with('global', 'We could\'t find your user.');
		} else {

			//update user to active state
			$user->active 			= 1;
			$user->activation_code 	= '';

			if($user->save()) {
				return Redirect::route('account-login')
						->with('globaltype', 'success')
						->with('global', 'Your account is now activated. Please log in.');
			} else {
				return Redirect::route('home')
					->with('globaltype', 'error')
					->with('global', 'Something went wrong while activating your account. Please try again later.');
			}
		}
		
		return Redirect::route('home')
			->with('globaltype', 'error')
			->with('global', 'Something went wrong while activating your account. Please try again later.');

	}

}
