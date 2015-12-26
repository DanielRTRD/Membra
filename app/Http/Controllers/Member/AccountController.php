<?php

namespace Membra\Http\Controllers\Member;

use Membra\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Redirect;

use Intervention\Image\Facades\Image;
use Regulus\ActivityLog\Models\Activity;

use Membra\Http\Requests\Member\SettingsRequest;
use Membra\Http\Requests\Member\PasswordRequest;
use Membra\Http\Requests\Member\ProfileImageRequest;
use Membra\Http\Requests\Member\ProfileCoverRequest;

use Membra\User;

class AccountController extends Controller {

	public function __construct() {
		$this->beforeFilter('csrf', ['on' => ['post']]);
		$this->beforeFilter('auth');
	}

	public function index(Guard $auth) {
		$authuser = $auth->user();
		return view('account.index')->with($authuser->toArray());
	}

	public function getSettings(Guard $auth) {
		$authuser = $auth->user();
		return view('account.settings')->with($authuser->toArray());
	}

	public function postSettings(Guard $auth, SettingsRequest $request) {
		
		$user 					= User::find($auth->user()->username);

		$user->showemail 		= $request->get('showemail');
		$user->showname 		= $request->get('showname');
		$user->showonline 		= $request->get('showonline');
		$user->userdateformat 	= $request->get('userdateformat');
		$user->usertimeformat 	= $request->get('usertimeformat');

		$usersave 				= $user->save();

		if($usersave) {
			return Redirect::route('account-settings')
					->with('messagetype', 'success')
					->with('message', 'Your settings has been saved!');
		} else {
			return Redirect::route('account-settings')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong when saving your settings.');
		}

	}

	public function getChangePassword(Guard $auth) {
		return view('account.changepassword');
	}

	public function postChangePassword(Guard $auth, PasswordRequest $request) {
		
		$user 				= User::find($auth->user()->username);
		$current_password 	= $request->get('current_password');
		$password 			= $request->get('password');
		$password_again 	= $request->get('password_again');

		if (\Hash::check($current_password, $user->getAuthPassword())) {
			$user->password = $password;
			if($user->save()) {
				\Auth::logout();
				return Redirect::route('home')
						->with('messagetype', 'success')
						->with('message', 'Your password has been changed! Please login again to confirm the password change.');
			} else {
				return Redirect::route('account-change-password')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong when saving your password.');
			}

		} else {
			return Redirect::route('account-change-password')
					->with('messagetype', 'warning')
					->with('message', 'Your current password does not seem to match.');
		}

	}

	public function getChangeDetails(Guard $auth) {
		$authuser = $auth->user();
		return view('account.changedetails')->with($authuser->toArray());
	}

	public function postChangeDetails(Guard $auth, SettingsRequest $request) {
		
		$user 					= User::find($auth->user()->username);

		$user->email 			= $request->get('email');
		$user->firstname 		= $request->get('firstname');
		$user->lastname 		= $request->get('lastname');
		$user->gender 			= $request->get('gender');
		$user->location 		= $request->get('location');
		$user->occupation 		= $request->get('occupation');

		if (\Hash::check($request->get('password'), $user->getAuthPassword())) {
			if($user->save()) {
				return Redirect::route('account-change-details')
						->with('messagetype', 'success')
						->with('message', 'Your details has been changed!');
			} else {
				return Redirect::route('account-change-details')
					->with('messagetype', 'danger')
					->with('message', 'Something went wrong when saving your details.');
			}

		} else {
			return Redirect::route('account-change-details')
					->with('messagetype', 'warning')
					->with('message', 'Your current password does not seem to match.');
		}

	}

	public function getChangeImages(Guard $auth) {
		$authuser = $auth->user();
		return view('account.changeimages')->with($authuser->toArray());
	}

	public function postChangeProfileImage(Guard $auth, ProfileImageRequest $request) {
		
		$user 				= User::find($auth->user()->username);

		$image 				= $request->file('profileimage');
		
		$filename 			= $auth->user()->id . '.' . $image->getClientOriginalExtension();
		$path 				= public_path() . '/img/profilepicture/' . $filename;
		$webpath			= '/img/profilepicture/' . $filename;

		$filename_small		= $auth->user()->id . '_small.' . $image->getClientOriginalExtension();
		$path_small 		= public_path() . '/img/profilepicture/' . $filename_small;
		$webpath_small		= '/img/profilepicture/' . $filename_small;

		//save image
		$imagesave 			= Image::make($image->getRealPath())->resize(250, null, function($constraint){ $constraint->aspectRatio(); })->save($path);
		$imagesave_small 	= Image::make($image->getRealPath())->fit(90)->save($path_small);
		// http://image.intervention.io/getting_started/installation

		//add image to db
		$user->profilepicture 		= $webpath;
		$user->profilepicturesmall 	= $webpath_small;
		$usersave 					= $user->save();

		if($imagesave && $usersave && $imagesave_small) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'success')
					->with('message', 'Your profile picture has been changed!');
		} else {
			return Redirect::route('account-change-images')
					->with('messagetype', 'danger')
					->with('message', 'Your profile picture could not be uploaded.');
		}

	}

	public function postChangeProfileCover(Guard $auth, ProfileCoverRequest $request) {
		
		$user 				= User::find($auth->user()->username);

		$image 				= $request->file('profilecover');
		
		$filename 			= $auth->user()->id . '.' . $image->getClientOriginalExtension();
		$path 				= public_path() . '/img/profilecover/' . $filename;
		$webpath			= '/img/profilecover/' . $filename;

		//save image
		$imagesave 			= Image::make($image->getRealPath())->resize(1500, null, function($constraint){ $constraint->aspectRatio(); })->save($path);
		// http://image.intervention.io/getting_started/installation

		//add image to db
		$user->profilecover 		= $webpath;
		$usersave 					= $user->save();

		if($imagesave && $usersave) {
			return Redirect::route('account-change-images')
					->with('messagetype', 'success')
					->with('message', 'Your profile cover has been changed!');
		} else {
			return Redirect::route('account-change-images')
					->with('messagetype', 'danger')
					->with('message', 'Your profile cover could not be uploaded.');
		}

	}

}
