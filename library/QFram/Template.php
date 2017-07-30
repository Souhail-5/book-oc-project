<?php
namespace QFram;

use QFram\Router;

/**
* Template manager
*/
abstract class Template
{
	use Helper\Utility;

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

	public function render()
	{
		if (file_exists(__DIR__.'/../../app/views/'.$this->view.'.php')) {
			extract($this->data);

			$current_route = Router::currentRoute();

			$path = function($route_name, $vars=[]) {
				return Router::genPath($route_name, $vars);
			};

			$_ifNotEmpty = function($test, $notEmpty, $empty='') {
				return $this->_ifNotEmpty($test, $notEmpty, $empty);
			};

			$_ifPlural = function($value, $plural, $singular='') {
				return $this->_ifPlural($value, $plural, $singular);
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
