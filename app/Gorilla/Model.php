<?php namespace Gorilla;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent {

	/**
	 * Enable automatic Author registration
	 *
	 * @var bool
	 */
	protected $autoAuthor = true;

	/**
	 * The name of the "created by" column.
	 *
	 * @var string
	 */
	const CREATED_BY = 'created_by';

	/**
	 * The name of the "updated by" column.
	 *
	 * @var string
	 */
	const UPDATED_BY = 'updated_by';

	/**
	 * The "booting" method of the model.
	 *
	 * @return void
	 */
	public static function boot()
	{
		parent::boot();

		static::saving(function($model)
		{
			if ($model->autoAuthor) $model->registerAuthor();
		});
	}

	/**
	 * Register the record Author
	 *
	 * @return void
	 */
	public function registerAuthor()
	{
		$username = Auth::check() ? Auth::user()->username : 'anonymous';

		if ( ! $this->exists)
		{
			$this->{static::CREATED_BY} = $this->{static::UPDATED_BY} = $username;
		}
		else
		{
			$this->{static::UPDATED_BY} = $username;
		}
	}

}