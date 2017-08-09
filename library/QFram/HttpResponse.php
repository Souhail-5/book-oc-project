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

	public function refresh($top=false)
	{
		$location = $top ? Router::currentPath().'#top' : Router::currentPath();
		header('Location: '.$location);
		exit;
	}

	public function send($content)
	{
		echo $content;
		exit;
	}
}
