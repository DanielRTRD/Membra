<?php

namespace App\Http\Controllers\Member;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->first();

		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		
		/*return View::make('account.profile')
					->with('user', $user);*/
		return view('profile.index')->with($theuser->toArray());
	}

}
