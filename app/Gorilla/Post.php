<?php namespace Gorilla;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Post extends Model {

	protected $table = 'posts';

	public function getDates()
	{
		return array(static::CREATED_AT, static::UPDATED_AT, static::DELETED_AT, 'publish_date');
	}

	public function image()
	{
		return $this->belongsTo(__NAMESPACE__ . '\Media', 'media_id');
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
			$model->title = trim($model->title);
			$model->slug  = $model->sluggify($model);

			if ( ! $model->publish_date)
			{
				$model->publish_date = Carbon::now();
			}
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
	 * @param  Post $model
	 * @return string
	 */
	public function sluggify(Post $model)
	{
		$slug   = Str::slug(trim($model->slug)) ?: Str::slug(trim($model->title));
		$others = $this->select('slug')->where('slug', 'like', "{$slug}%")->where('id', '!=', $model->id)->lists('slug');

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