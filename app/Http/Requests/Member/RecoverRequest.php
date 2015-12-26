<?php

namespace Membra\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class RecoverRequest extends FormRequest {
	public function rules() {
		return [
			'password'		=> 'required|confirmed|min:8|max:64',
		];
	}
	
	public function authorize() {
		return true;
	}
}