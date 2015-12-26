<?php

namespace Membra\Http\Controllers\Member;

use Membra\Http\Controllers\Controller;
use Membra\User;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->where('active', '=', 1)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		return view('account.profile')->with($theuser->toArray());
	}

	public function getMembers() {
		$members = User::where('active', '=', 1)->orderBy('username', 'asc')->paginate(15);
		$newestmembers = User::where('active', '=', 1)->orderBy('created_at', 'desc')->take(5)->get();
		$onlinemembers = User::where('active', '=', 1)->orderBy('last_activity', 'desc')->take(5)->get();
		
		return view('account.members')
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

}
