<?php

if ( ! function_exists('is_iteable'))
{
	/**
	 * Check if a variable is iterable
	 *
	 * @param  mixed $variable
	 * @return bool
	 */
	function is_iterable($var)
	{
		return (is_array($var) or $var instanceof Traversable);
	}
}

if ( ! function_exists('gravatar'))
{
	/**
	 * Generate a URL to a Gravatar profile
	 *
	 * @param  string  $email
	 * @param  integer $size
	 * @return string
	 */
	function gravatar($email, $size = 40)
	{
		return "http://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?s=" . $size;;
	}
}