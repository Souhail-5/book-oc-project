<?php
namespace QFram;

use \QFram\HTTPRequest;
use \QFram\Route;

/**
* Router manager
*/
class Router
{
	protected $HTTPRequest;
	protected $route;

	protected static $routes;

	public function __construct(HTTPRequest $request)
	{
		$this->HTTPRequest = $request;
		self::$routes = !empty(self::$routes) ? self::$routes : json_decode(file_get_contents(__DIR__.'/../../app/config/routes.json'), true);
		$this->setRoute();
	}

	protected function setRoute()
	{
		foreach (self::$routes as $route_name => $param) {
			$param['varsNames'] = isset($param['varsNames']) ? $param['varsNames'] : [];
			$route = new Route($route_name, $param['url'], $param['controller'], $param['action'], $param['varsNames']);

			if ($route->match($this->HTTPRequest->getURI())) {
				$this->route = $route;
				$this->HTTPRequest->setGETData($this->route->vars);
			}
		}
	}

	public static function getPath($route_name, array $vars=[])
	{
		if (!empty(self::$routes[$route_name])) {
			return preg_replace_callback_array(
				[
					'`\([^\)]*\)(?!\?)`U' => function($matches) use(&$vars) {
						return array_shift($vars);
					},
					'`\([^\)]*\)\?`U' => function($matches) {
						return "";
					}
				],
				self::$routes[$route_name]['url']
			);
		} else {
			return "/";
		}
	}

	public function runController()
	{
		$controller = '\Controller\\'.ucfirst($this->route->controller);
		new $controller;
	}

	// // generate URL from route name and param
	// public static function generate($value, array $param)
	// {
	// 	# code...
	// }
}
