<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use App\User;

class AccountController extends Controller {

	public function __construct() {
		$this->beforeFilter('csrf', ['on' => ['post']]);
		$this->beforeFilter('auth');
	}

	public function index(Guard $auth) {
		$authuser = $auth->user();
		return view('account.index')->with($authuser->toArray())->with($getUserDateFormat);
	}

}
