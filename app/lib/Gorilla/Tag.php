<?php namespace Gorilla;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Tag extends Model {

	protected $table = 'tags';
	protected $fillable = array('post_id', 'slug', 'name');

	public function posts()
	{
		$tagTable  = $this->getTable();
		$postTable = with(new Post)->getTable();

		return Post::join($tagTable, "{$postTable}.id", "=", "{$tagTable}.post_id")->where("{$tagTable}.name", $this->name);
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS
	|--------------------------------------------------------------------------
	*/
	public function getUrlAttribute()
	{
		return URL::route('tag', array('name' => $this->slug));
	}

	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/
	public static function boot()
	{
		parent::boot();

		static::saving(function($model)
		{
			$model->name = trim($model->name);
			$model->slug = Str::slug($model->name);
		});
	}
}