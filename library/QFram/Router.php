<?php
namespace QFram;

use \QFram\HttpRequest;
use \QFram\HttpResponse;
use \QFram\Route;

/**
* Router manager
*/
class Router
{
	protected $HttpRequest;
	protected $HttpResponse;

	protected static $currentRoute;
	protected static $routes;

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->setRoutes();
	}

	protected function isCurrentRoute(Route $route)
	{
		return $route->isValidUrl($this->HttpRequest->getURI());
	}

	public static function currentRoute()
	{
		return self::$currentRoute;
	}

	public static function currentPath()
	{
		return self::genPath(self::$currentRoute->name(), self::$currentRoute->vars());
	}

	public static function genPath($route_name, array $vars=[])
	{
		$hasVars = !empty($vars);
		if (!empty(self::$routes[$route_name])) {
			return preg_replace_callback_array(
				[
					'`\((?!\?:)[^\)]*\)(?!\?)`U' => function($matches) use(&$vars) {
						return array_shift($vars);
					},
					'`\((?!\?:)[^\)]*\)\?`U' => function($matches) {
						return '';
					},
					'`\((?=\?:)[^\)]*\)\?`U' => function($matches) use($hasVars) {
						if ($hasVars) return implode(str_replace(['(?:', ')?'], '', $matches));
						return '';
					}
				],
				self::$routes[$route_name]->urlPattern()
			);
		} else {
			return "/";
		}
	}

	protected function setRoutes()
	{
		$config_routes = json_decode(file_get_contents(__DIR__.'/../../app/config/routes.json'), true);

		foreach ($config_routes as $route_name => $param) {
			$param['varsNames'] = isset($param['varsNames']) ? $param['varsNames'] : [];
			$param['before'] = isset($param['before']) ? $param['before'] : [];
			$param['breadcrumb'] = isset($param['breadcrumb']) ? $param['breadcrumb'] : [];
			$config = [
				'name' => $route_name,
				'urlPattern' => $param['url'],
				'controller' => $param['controller'],
				'action' => $param['action'],
				'varsNames' => $param['varsNames'],
				'varsFromUrl' => $this->HttpRequest->getURI(),
				'before' => $param['before'],
				'breadcrumb' => $param['breadcrumb'],
			];

			self::$routes[$route_name] = new Route($config);

			if ($this->isCurrentRoute(self::$routes[$route_name])) $this->setCurrentRoute(self::$routes[$route_name]);
		}

		if (!self::$currentRoute) $this->HttpResponse->redirect(self::genPath('404'));
	}

	protected function setCurrentRoute(Route $route)
	{
		self::$currentRoute = $route;
		if ($this->HttpRequest->POSTData('action')) self::$currentRoute->setAction($this->HttpRequest->POSTData('action'));
		$this->HttpRequest->setGETData(self::$currentRoute->vars());
	}

	public function run()
	{
		if (!empty(self::$currentRoute->before())) {
			$before = self::$currentRoute->before();
			foreach ($before as $key => $value) {
				$controller = '\Controller\\'.$before[$key]["controller"];
				$controller = new $controller($this->HttpRequest, $this->HttpResponse, $before[$key]["action"]);
				$controller->run();
			}
		}
		$controller = '\Controller\\'.self::$currentRoute->controller();
		$controller = new $controller($this->HttpRequest, $this->HttpResponse, self::$currentRoute->action());
		$controller->run();
	}
}
