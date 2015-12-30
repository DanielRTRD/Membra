<?php namespace Membra;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

	protected $fillable = ['title', 'content', 'slug', 'published_at'];
	protected $table = 'news';

	function category() {
		return $this->hasOne('NewsCategory', 'id', 'category_id');
	}

	function scopeIsPublished($query) {
		return $query->where('published_at', '<', \DB::raw('now()'));
	}

	function isPublished() {
		return ($this->published_at !== '0000-00-00 00:00:00');
	}

}
