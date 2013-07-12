<?php namespace Gorilla;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class Tag extends Model {

	protected $table = 'tags';
	protected $fillable = array('post_id', 'name');

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
		return URL::route('tags', array('name' => Str::slug($this->name)));
	}

}