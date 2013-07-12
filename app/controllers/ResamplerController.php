<?php

class ResamplerController extends Controller {

	public function resample()
	{
		$url = urldecode(Input::get('url', ''));

		if ( ! $url)
		{
			App::abort(500, 'Missing image URL');
		}

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
			call_user_func_array(array($image, $name), $this->extractParams($name, $value));
		}

		return Response::make($image->encode(), 200, array(
			'Content-Type' => $image->mime
		));
	}

	public function extractParams($method, $qstring)
	{
		$params = explode(',', $qstring);
		$params = array_map(function($param)
		{
			if ( ! is_numeric($param))
			{
				$param = strtolower($param);

				if ($param == 'null') $param = null;
				if (in_array($param, array('true', 'false'))) $param = $param == 'true';
			}

			return $param;

		}, $params);

		if ($method == 'resize')
		{
			if ( ! isset($params[1])) $params[1] = null;

			// Di default, mantengo il rapporto Larghezza/Altezza in fase di ridimensionamento
			if (is_null($params[1]) and ! isset($params[2])) $params[2] = true;
		}

		return $params;
	}

}