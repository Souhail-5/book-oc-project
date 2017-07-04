<?php

/**
* Router manager
*/
class Router
{
	private $_HTTPRequest;
	private $_routes = array();
	public $route;

	public function __construct(HTTPRequest $request)
	{
		$this->_HTTPRequest = $request;
		$this->setRoute();
	}

	private function setRoutes()
	{
		$json = file_get_contents('config/routes.json');
		$routes = json_decode($json, true);

		foreach ($routes as $route_name => $param) {
			$param['varsNames'] = isset($param['varsNames']) ? $param['varsNames'] : [];
			$this->_routes[$route_name] = new Route($route_name, $param['url'], $param['controller'], $param['action'], $param['varsNames']);
		}
	}

	private function setRoute()
	{
		$this->setRoutes();

		foreach ($this->_routes as $route) {
			if ($this->match($this->_HTTPRequest->getURI(), $route)) {
				$this->route = $route;
			}
		}
	}

	public function match($url, Route $route)
	{
		if (preg_match('`^'.$route->url.'$`', $url, $matches)) {
			if ($route->hasVars()) {
				$vars = [];
				foreach ($matches as $key => $match) {
					if ($key !== 0) {
						$vars[$route->varsNames[$key - 1]] = $match;
					}
				}
				$route->vars = $vars;
			}
			return true;
		} else {
			return false;
		}
	}

	public function getRoutes()
	{
		return $this->_routes;
	}

	// Redirect to appropriate controller

	// generate URL from route name and param
}
