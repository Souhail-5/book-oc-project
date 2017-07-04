<?php
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

	public function hasVars()
	{
		return !empty($this->varsNames);
	}

	public function __set($property, $value)
	{
		$method = "set".ucfirst($property);
		method_exists($this, $method) ? $this->$method($value) : trigger_error("Not allowed to modify this $property");
	}

	public function setVars(array $vars)
	{
		$this->vars = $vars;
	}
}
