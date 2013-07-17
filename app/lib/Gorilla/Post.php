<?php namespace Gorilla;

use Twig_Loader_String;
use TwigBridge\TwigBridge;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

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

	public function tags()
	{
		return $this->hasMany(__NAMESPACE__ . '\Tag');
	}

	public function author()
	{
		return $this->belongsTo(__NAMESPACE__ . '\User', 'created_by');
	}

	/*
	|--------------------------------------------------------------------------
	| ACCESSORS
	|--------------------------------------------------------------------------
	*/
	public function getUrlAttribute()
	{
		return URL::route('post', array('slug' => $this->slug));
	}

	/**
	 * Content parsered with Twig
	 * @return string
	 */
	public function getParsedContentAttribute()
	{
		$bridge = new TwigBridge(app());
		$loader = new Twig_Loader_String;

		$twig = $bridge->getTwig();
		$twig->setLoader($loader);

		return $twig->loadTemplate($this->content)->render(array(
			'post' => $this
		));
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

	/**
	 * Create/Delete related post Tags
	 *
	 * @param  array  $input
	 * @return string
	 */
	public function syncTags(array $input)
	{
		$tags = $this->tags()->lists('name');

		$toDelete = array_filter(array_diff($tags, $input));
		$toInsert = array_filter(array_diff($input, $tags));

		if ($toDelete)
		{
			$this->tags()->whereIn('name', $toDelete)->delete();
		}

		foreach ($toInsert as $name)
		{
			$this->tags()->create(array('post_id' => $this->id, 'name' => $name));
		}
	}

}