<?php
namespace QFram;

use QFram\Router;

/**
* Template manager
*/
class Template
{
	private $_path;
	private $_data;

	public function __construct($path, array $data=array())
	{
		$this->_path = $path;
		$this->_data = $data;
	}

	public function __set($property, $value)
	{
		return $this->_data[$property] = $value;
	}

	public function __get($property)
	{
		return array_key_exists($property, $this->_data) ? $this->_data[$property] : null;
	}

	protected function path($route_name, array $vars)
	{
		return Router::getPath($route_name, $vars);
	}

	public function render()
	{
		if (file_exists(__DIR__.'/../../app/views/'.$this->_path.'.php')) {
			extract($this->_data);

			$path = function($route_name, $vars=[]) {
				return $this->path($route_name, $vars);
			};

			ob_start();
				include(__DIR__.'/../../app/views/'.$this->_path.'.php');
				$rendering = ob_get_contents();
			@ob_end_clean();

			return $rendering;
		} else {
			//Throws exception
		}
	}
}
