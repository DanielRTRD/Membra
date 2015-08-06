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

	public function getLogin() {
		return view('auth.login');
	}

	public function postLogin(LoginRequest $request) {
		if ($this->auth->attempt($request->credentials(), $request->remember())) {
			$user = $this->auth->user();
			//return Redirect::intended(route('profile', [$user->getKey()]));
			return Redirect::route('home')->with('messagetype', 'success')->with('message', 'You have now been successfully been logged in.');
		}
	 
		return Redirect::route('login')
				->withErrors([
					'email' => 'The credentials you entered did not match our records. Try again?'
					]);
	}
	 
	public function getRegister() {
		return view('auth.register');
	}

	public function postRegister(RegisterRequest $request) {

		/*$user = User::create($request->all());
		$this->auth->login($user);
		return Redirect::route('home');*/

		$email 			= $request->get('email');
		$firstname 		= $request->get('firstname');
		$lastname 		= $request->get('lastname');
		$username 		= $request->get('username');
		$password 		= $request->get('password');
		$referral		= $request->get('referral');
		$referral_code 	= str_random(15);
		$code 			= str_random(60); // Activation Code

		$user = User::create(array(
			'email' 		=> $email,
			'username'		=> $username,
			'firstname'		=> $firstname,
			'lastname'		=> $lastname,
			'password'		=> $password,
			'code'			=> $code,
			'referral'		=> $referral,
			'referral_code'	=> $referral_code,
			'active'		=> 0
		));

		if($user) {

			Mail::send('emails.auth.activate', array('link' => URL::route('account-activate', $code), 'firstname' => $firstname), function($message) use ($user) {
				$message->to($user->email, $user->firstname)->subject('Activate your account');
			});
			Session::forget('referral'); //forget the referralRolig

			return Redirect::refresh()
					->with('messagetype', 'success')
					->with('message', 'Your account has been created! We have sent you an email to acitvate your account.');

		}
	}
	 
	public function getLogout() {
		$this->auth->logout();
		return Redirect::route('home')->with('messagetype', 'success')->with('message', 'You have now been successfully been logged out!');
	}

}
