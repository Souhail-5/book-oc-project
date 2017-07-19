<?php
namespace QFram;

/**
* Route model
*/
class Route
{
	protected $name;
	protected $url;
	protected $controller;
	protected $action;
	protected $varsNames = array();
	protected $vars = array();

	public function __construct($name, $url, $controller, $action, array $varsNames)
	{
		$this->name = $name;
		$this->url = $url;
		$this->controller = $controller;
		$this->action = $action;
		$this->varsNames = $varsNames;
	}

	// To-do: transform it to a Trait
	public function hydrate(array $data)
	{
		foreach ($data as $property => $value) {
			$method = 'set'.ucfirst($property);
			if (method_exists($this, $method)) $this->$method($value);
		}
	}

	public function match($url)
	{
		if (preg_match('`^'.$this->url.'(?:\\?[a-z0-9-&=]{3,})?$`', $url, $matches)) {
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

	public function name() { return $this->name; }
	public function url() { return $this->url; }
	public function controller() { return $this->controller; }
	public function action() { return $this->action; }
	public function varsNames() { return $this->varsNames; }
	public function vars() { return $this->vars; }

	public function setName($value)
	{
		$this->name = $value;
	}

	public function setUrl($value)
	{
		$this->url = $value;
	}

	public function setController($value)
	{
		$this->controller = $value;
	}

	public function setAction($value)
	{
		$this->action = $value;
	}

	public function setVarsNames($value)
	{
		$this->varsNames = $value;
	}

	public function setVars($value)
	{
		$this->vars = $value;
	}

}
