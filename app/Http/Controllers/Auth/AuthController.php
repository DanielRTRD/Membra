<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

use Illuminate\Support\Facades\Redirect;
use App\User;

class AuthController extends Controller {

	use AuthenticatesAndRegistersUsers;
 
	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;
 
		$this->beforeFilter( 'csrf' , ['on' => ['post']] );
		$this->beforeFilter( 'guest' , ['except' => ['getLogout']] );
	}

	public function getLogin() {
		return view( 'auth.login' );
	}

	public function postLogin( LoginRequest $request ) {
		if ( $this->auth->attempt( $request->credentials() , $request->remember() ) ) {
	 
			$user = $this->auth->user();
			// if you use database not eloquent driver 
			//$user = User::where( 'id' , '=' , $this->auth->user()->id )->first();
			 
			//return redirect( '/' );
			return Redirect::intended( route( 'profile' , [$user->getKey()] ) );
		}
	 
		//return redirect( 'auth/login' )->withErrors( [
		return Redirect::route( 'login' )->withErrors( [
					'email' => 'The credentials you entered did not match our records. Try again?' ,
				] );
	}
	 
	public function getRegister() {
		return view( 'auth.register' );
	}

	public function postRegister( RegisterRequest $request ) {
		$user = User::create( $request->all() ); // new line
		$this->auth->login( $user );
	 
		//return redirect( '/' );
		return Redirect::route( 'home' );
	}
	 
	public function getLogout() {
		$this->auth->logout();
	 
		return redirect( '/' );
		//return Redirect::route( 'home' );
	}



}
