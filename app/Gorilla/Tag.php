<?php namespace Gorilla;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Tag extends Model {

	protected $table = 'tags';
	protected $fillable = array('post_id', 'slug', 'name');

	public function posts()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Post');
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