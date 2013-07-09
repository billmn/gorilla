<?php namespace Gorilla;

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Hash;

class UserChangeNotAllowed extends \Exception { }

class User extends Model implements UserInterface, RemindableInterface {

	protected $table = 'users';
	protected $admin = 'admin';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Hash password on set
	 */
	public function setPasswordAttribute($password)
	{
		$this->attributes['password'] = Hash::make($password);
	}


	public function posts()
	{
		return $this->hasMany(__NAMESPACE__ . '\Post', 'created_by');
	}


	/*
	|--------------------------------------------------------------------------
	| EVENTS
	|--------------------------------------------------------------------------
	*/
	public static function boot()
	{
		parent::boot();

		static::updating(function($model)
		{
			// Admin username cannot be changed
			if (strtolower($model->getOriginal('username')) == $model->admin and strtolower($model->username) != $model->admin)
			{
				throw new UserChangeNotAllowed(Lang::get('gorilla.users.msg.admin_username_error', array('username' => $model->admin)));
			}

			// Admin cannot be disabled
			if ($model->isAdmin() and $model->enabled == false)
			{
				throw new UserChangeNotAllowed(Lang::get('gorilla.users.msg.admin_disable_error', array('username' => $model->admin)));
			}
		});

		static::deleting(function($model)
		{
			// Admin cannot be deleted
			if ($model->isAdmin())
			{
				throw new UserChangeNotAllowed(Lang::get('gorilla.users.msg.admin_delete_error', array('username' => $model->admin)));
			}
		});
	}

	/*
	|--------------------------------------------------------------------------
	| UTILITY
	|--------------------------------------------------------------------------
	*/
	public function isAdmin()
	{
		return $this->username === $this->admin;
	}

}