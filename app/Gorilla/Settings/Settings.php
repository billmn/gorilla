<?php namespace Gorilla;

class Settings extends Model {

	protected $table = 'settings';
	protected $primaryKey = 'name';

	/**
	 * Give a setting value
	 *
	 * @param  string  $name
	 * @param  mixed   $default
	 * @return mixed
	 */
	public static function give($name, $default = null)
	{
		if ($setting = static::find($name))
		{
			return $setting->value;
		}

		return $default;
	}

	/*
	|--------------------------------------------------------------------------
	| SCOPES
	|--------------------------------------------------------------------------
	*/
	protected function getValueAttribute($value)
	{
		return is_serialized($value) ? unserialize($value) : $value;
	}

	protected function setValueAttribute($value = null)
	{
		$this->attributes['value'] = (is_array($value) or is_object($value)) ? serialize($value) : $value;
	}

}