<?php
namespace QFram;

/**
* Http Request manager
*/
class HttpRequest
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

	public function GETData($key)
	{
		return isset($_GET[$key]) ? $_GET[$key] : null;
	}

	public function setPOSTData(array $vars)
	{
		$_POST = array_merge($_POST, $vars);
	}

	public function POSTData($key)
	{
		return isset($_POST[$key]) ? $_POST[$key] : null;
	}
}
