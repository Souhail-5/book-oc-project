<?php
namespace QFram;

/**
* HTTP Request manager
*/
class HTTPRequest
{
	public function getURI()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public function setGETData(array $vars)
	{
		$_GET = array_merge($_GET, $vars);
	}
}
