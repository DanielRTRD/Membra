<?php namespace Membra;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

	protected $fillable = [
		'title',
		'content',
		'slug',
		'published_at',
		'category_id',
		'creator_id',
	];
	protected $table = 'news';

	function category() {
		return $this->hasOne('NewsCategory', 'id', 'category_id');
	}

	function scopeIsPublished($query) {
		return $query->where('published_at', '<', \DB::raw('now()'))->orderBy('published_at', 'desc');
	}

	function scopeIsActive($query) {
		return $query->where('active', '=', 1)->orderBy('published_at', 'desc');
	}

}
