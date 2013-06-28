<?php

class ResamplerController extends Controller {

	public function resample()
	{
		$url        = urldecode(Input::get('url', ''));
		$width      = Input::get('width', null);
		$height     = Input::get('height', null);
		$background = Input::get('background', 'transparent');

		if ( ! $url) App::abort(500, 'Missing image URL');

		// Image path
		$path = app('path.public') . parse_url($url, PHP_URL_PATH);
		if ( ! File::exists($path)) App::abort(500, 'File does not exists');

		// Resampler parameters
		parse_str(Input::server('QUERY_STRING'), $params);

		// Resampler allowed methods
		$allowed = array('resize', 'grab', 'crop', 'opacity', 'brightness', 'contrast', 'greyscale', 'grayscale', 'invert', 'pixelate', 'blur', 'flip', 'rotate', 'text');
		$params  = array_only($params, $allowed);

		$image = Image::open($path);

		foreach ($params as $name => $value)
		{
			try
			{
				@call_user_func_array(array($image, $name), explode(',', $value));
			}
			catch (Exception $e)
			{
				// do nothing ...
			}
		}

		return Response::make($image->encode(), 200, array(
			'Content-Type' => $image->mime
		));
	}

}