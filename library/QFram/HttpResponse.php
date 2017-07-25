<?php
namespace QFram;

use \Qfram\Router;

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

	public function refresh()
	{
		header('Location: '.Router::currentPath());
		exit;
	}

	public function send($content)
	{
		echo $content;
	}
}
