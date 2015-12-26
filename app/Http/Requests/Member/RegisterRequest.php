<?php

namespace Membra\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class RegisterRequest extends FormRequest {
	public function rules() {
		return [
			'username'		=> 'required|min:3|max:25|unique:users|not_in:email',
			'firstname'		=> 'required|min:3|max:250|regex:/^[A-Za-z0-9\-! ,\'\"\/@\.:\(\)]+$/',
			'lastname'		=> 'min:3|max:250|regex:/^[A-Za-z0-9\-! ,\'\"\/@\.:\(\)]+$/',
			'email'			=> 'required|max:50|email|unique:users',
			'password'		=> 'required|confirmed|min:8|max:64|not_in:email,username,firstname',
			'tos'			=> 'accepted',
		];
	}
 
	public function authorize() {
		return true;
	}
}