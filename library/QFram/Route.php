<?php
namespace QFram;

/**
* Route model
*/
class Route
{
	public $name;
	public $url;
	public $controller;
	public $action;
	public $varsNames = array();
	public $vars = array();

	public function __construct($name, $url, $controller, $action, array $varsNames)
	{
		$this->name = $name;
		$this->url = $url;
		$this->controller = $controller;
		$this->action = $action;
		$this->varsNames = $varsNames;
	}

	public function match($url)
	{
		if (preg_match('`^'.$this->url.'(?:\\?[a-z0-9-&=]*)?$`', $url, $matches)) {
			if (!empty($this->varsNames)) {
				$vars = [];
				foreach ($matches as $key => $match) {
					if ($key !== 0) {
						$vars[$this->varsNames[$key - 1]] = $match;
					}
				}
				$this->vars = $vars;
			}
			return true;
		} else {
			return false;
		}
	}
}
