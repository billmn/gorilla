<?php namespace Gorilla;

class Tag extends Model {

	protected $table = 'tags';
	protected $fillable = array('post_id', 'name');

	public function posts()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Post');
	}

}