<?php namespace Gorilla\Theme;

use Carbon\Carbon;

use Gorilla\Tag;
use Gorilla\Post;
use Gorilla\Settings;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

class Tags {

	protected $post;
	protected $settings;

	public function __construct()
	{
		if (Request::is('post/*'))
		{
			$this->post = Post::where('slug', Request::segment(2))->where('publish_date', '<=', Carbon::now())->first();
		}

		$this->settings = Settings::all()->lists('value', 'name');
	}

	public function posts($params = array())
	{
		$tagsTable  = with(new Tag)->getTable();
		$postsTable = with(new Post)->getTable();

		$pagination = (isset($params['paginate']) and is_numeric($params['paginate'])) ? $params['paginate'] : 5;

		$posts = Post::with('tags', 'author', 'image')->select("{$postsTable}.*");

		if ($tag = array_get($params, 'with_tag'))
		{
			$posts = $posts->join("{$tagsTable}", "{$postsTable}.id", '=', "{$tagsTable}.post_id")->where("{$tagsTable}.slug", '=', $tag);
		}

		$posts = $posts
					->where('publish_date', '<=', Carbon::now())
					->orderBy('publish_date', 'desc')
					->distinct()
					->paginate($pagination);

		return $posts;
	}

	public function settings($name, $default = null)
	{
		return array_get($this->settings, $name, $default);
	}

}