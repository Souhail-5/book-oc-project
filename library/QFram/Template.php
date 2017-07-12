<?php
namespace QFram;

use QFram\Router;

/**
* Template manager
*/
abstract class Template
{
	protected $view;
	protected $data;

	public function __construct($view, array $data=array())
	{
		$this->view = $view;
		$this->data = $data;
	}

	public function __set($property, $value)
	{
		return $this->data[$property] = $value;
	}

	public function __get($property)
	{
		return array_key_exists($property, $this->data) ? $this->data[$property] : null;
	}

	public function path($route_name, array $vars)
	{
		return Router::getPath($route_name, $vars);
	}

	public function render()
	{
		if (file_exists(__DIR__.'/../../app/views/'.$this->view.'.php')) {
			extract($this->data);

			$path = function($route_name, $vars=[]) {
				return $this->path($route_name, $vars);
			};

			ob_start();
				include(__DIR__.'/../../app/views/'.$this->view.'.php');
				$rendering = ob_get_contents();
			@ob_end_clean();

			return $rendering;
		} else {
			//Throws exception
		}
	}
}
