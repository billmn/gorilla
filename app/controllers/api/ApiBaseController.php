<?php

class ApiBaseController extends Controller {

	public function __construct()
	{
		if ( ! Auth::user()->enabled)
		{
			header('HTTP/1.1 401 Unauthorized', true, 401);
			exit('Your user id disabled');
		}
	}

}