<?php

namespace App\Http\Requests\Auth;
 
use Illuminate\Foundation\Http\FormRequest;
 
class RegisterRequest extends FormRequest {
    public function rules() {
        return [
        	'username'      => 'required|unique:users',
            'name'          => 'required',
            'email'         => 'required|email|unique:users' ,
            'password'      => 'required|confirmed|min:8' ,
        ];
    }
 
    public function authorize() {
        return true;
    }
}