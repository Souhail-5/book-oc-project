<?php
namespace QFram;

/**
* Http Response manager
*/
class HttpResponse
{
	public function addHeader($header)
	{
		header($header);
	}

	public function redirect($location)
	{
		header('Location: '.$location);
		exit;
	}
}
