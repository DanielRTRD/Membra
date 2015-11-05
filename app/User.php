<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword, SoftDeletes;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['firstname', 'lastname', 'username', 'email', 'password', 'activation_code'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	protected $primaryKey = 'username';
	protected $dates = ['deleted_at'];

	public function setPasswordAttribute($password) {
		$this->attributes['password'] = bcrypt($password);
	}

	public function scopeGetLastActivity($query, $id, $short = false) {

		$user 		= $query->where('id', '=', $id)->first();
		$time 		= $user->last_activity;

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$HOUR 		= 60 * $MINUTE;
		$DAY 		= 24 * $HOUR;
		$MONTH 		= 30 * $DAY;
		$before 	= time() - strtotime($time);

		if ($before < 0) {
		    return "not yet";
		}

		if ($time == '0000-00-00 00:00:00') {
			return "never";
		}

		if ($short) {

		    if ($before < 1 * $MINUTE) {
		        return ($before <5) ? "just now" : $before . " ago";
		    }

		    if ($before < 2 * $MINUTE) {
		        return "1m ago";
		    }

		    if ($before < 45 * $MINUTE) {
		        return floor($before / 60) . "m ago";
		    }

		    if ($before < 90 * $MINUTE) {
		        return "1h ago";
		    }

		    if ($before < 24 * $HOUR) {
		        return floor($before / 60 / 60). "h ago";
		    }

		    if ($before < 48 * $HOUR) {
		        return "1d ago";
		    }

		    if ($before < 30 * $DAY) {
		        return floor($before / 60 / 60 / 24) . "d ago";
		    }

		    if ($before < 12 * $MONTH) {
		        $months = floor($before / 60 / 60 / 24 / 30);
		        return $months <= 1 ? "1mo ago" : $months . "mo ago";
		    } else {
		        $years = floor  ($before / 60 / 60 / 24 / 30 / 12);
		        return $years <= 1 ? "1y ago" : $years."y ago";
		    }

		}

		if ($before < 1 * $MINUTE) {
		    return ($before <= 1) ? "just now" : $before . " seconds ago";
		}

		if ($before < 2 * $MINUTE) {
		    return "a minute ago";
		}

		if ($before < 45 * $MINUTE) {
		    return floor($before / 60) . " minutes ago";
		}

		if ($before < 90 * $MINUTE) {
		    return "an hour ago";
		}

		if ($before < 24 * $HOUR) {
		    return (floor($before / 60 / 60) == 1 ? 'about an hour' : floor($before / 60 / 60).' hours'). " ago";
		}

		if ($before < 48 * $HOUR) {
		    return "yesterday";
		}

		if ($before < 30 * $DAY) {
		    return floor($before / 60 / 60 / 24) . " days ago";
		}

		if ($before < 12 * $MONTH) {
		    $months = floor($before / 60 / 60 / 24 / 30);
		    return $months <= 1 ? "one month ago" : $months . " months ago";
		} else {
		    $years = floor  ($before / 60 / 60 / 24 / 30 / 12);
		    return $years <= 1 ? "one year ago" : $years." years ago";
		}

	}

	public function scopeGetStatus($query, $id) {

		$user 		= $query->where('id', '=', $id)->first();
		$time 		= $user->last_activity;

		$SECOND 	= 1;
		$MINUTE 	= 60 * $SECOND;
		$before 	= time() - strtotime($time);

		if ($time == "0000-00-00 00:00:00") {
			return "offline";
		}

		if ($before < 5 * $MINUTE) {
		    return "online";
		} elseif ($before < 10 * $MINUTE) {
		    return "away";
		} else {
			return "offline";
		}

	}

	public function scopeGetUserDateFormat($query) {

		if(Auth::check()) {
			$user 		= $query->where('id', '=', Auth::user()->id)->first();
			$format 	= $user->userdateformat;

			if($format == null) {
				$format = 'd. M Y';
			}

		} else {
			$format = 'd. M Y';
		}

		return $format;
	}

	public function scopeGetUserTimeFormat($query) {

		if(Auth::check()) {
			$user 		= $query->where('id', '=', Auth::user()->id)->first();
			$format 	= $user->usertimeformat;

			if($format == null) {
				$format = 'H:i';
			}

		} else {
			$format = 'H:i';
		}

		return $format;
	}

}
