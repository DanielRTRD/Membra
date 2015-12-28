<?php

namespace Membra\Http\Controllers\Member;

use Membra\Http\Controllers\Controller;
use Membra\User;

class ProfileController extends Controller {

	public function index($username) {
		$theuser = User::where('username', '=', $username)->first();
		if($theuser == null) {
			return abort(404); //if username does not exist
		}
		$onlinestatus = User::getOnlineStatus($theuser->id);
		$userarray = $theuser->toArray();
		$userarray['onlinestatus'] = $onlinestatus;
		return view('account.profile')->with($userarray);
	}

	public function getMembers() {
		$members = User::orderBy('username', 'asc')->paginate(15);
		$newestmembers = User::orderBy('created_at', 'desc')->take(5)->get();
		$onlinemembers = User::orderBy('last_activity', 'desc')->take(5)->get();
		
		return view('account.members')
				->with('members', $members)
				->with('newestmembers', $newestmembers)
				->with('onlinemembers', $onlinemembers);
	}

}
