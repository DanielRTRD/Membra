<?php

namespace Membra\Http\Requests\News;
 
use Illuminate\Foundation\Http\FormRequest;
 
class NewsCreateRequest extends FormRequest {
	public function rules() {
		return [
			'title' 		=> 'required',
			'content' 		=> 'required',
			'category_id' 	=> 'required|integer',
		];
	}
	
	public function authorize() {
		return true;
	}
}