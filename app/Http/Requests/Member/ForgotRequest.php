<?php

namespace Membra\Http\Requests\Member;
 
use Illuminate\Foundation\Http\FormRequest;
 
class ForgotPasswordRequest extends FormRequest {
	public function rules() {
		return [
			'email' 		=> 'required',
		];
	}
	
	public function authorize() {
		return true;
	}
}