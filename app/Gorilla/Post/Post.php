<?php namespace Gorilla;

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Support\Str;

class Post extends Eloquent {

	protected $table = 'posts';

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
			$model->title = trim($model->title);
			$model->slug  = static::sluggify($model->title, $model->exists ? $model->id : null);
		});
	}

	/*
	|--------------------------------------------------------------------------
	| UTILITY
	|--------------------------------------------------------------------------
	*/
	/**
	 * Generate Slug by checking if already exists
	 *
	 * @param  string  $title
	 * @param  integer $postId  Post ID if already exists
	 * @return string
	 */
	public static function sluggify($title, $postId = null)
	{
		$slug = Str::slug(trim($title), '-');
		$others = static::select('slug')->where('slug', 'like', "{$slug}%")->where('id', '!=', $postId)->lists('slug');

		// This Slug already exists ... increment !
		if (in_array($slug, $others))
		{
			$others = array_filter($others, function($item) use ($slug)
			{
				return starts_with($item, "{$slug}-");
			});

			// Already exists others increments ... increment again ! ( eg. post-1-2 )
			if (count($others))
			{
				$others = array_map(function($item)
				{
					$parts = explode('-', $item);
					if (is_numeric(end($parts))) return end($parts);

				}, $others);

				return trim($slug, '-') . '-' . (max($others) + 1);
			}
			else
			{
				return trim($slug, '-') . '-1';
			}
		}
		else
		{
			return $slug;
		}
	}

}