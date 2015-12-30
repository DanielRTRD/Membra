<?php namespace Membra;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model {

	protected $table = 'news_categories';

	public function categories() {
		return $this->hasMany('News', 'category_id');
	}

}
