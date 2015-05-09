<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		return view('account.profile')->with($theuser->toArray());
	}

}
