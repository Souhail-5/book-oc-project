<?php
namespace Controller;

use \QFram\HttpRequest;
use \QFram\HttpResponse;
use \QFram\Page;
use \QFram\Component;

/**
* Controller Base
*/
// To-do: Move to /library/QFram
abstract class Controller
{
	protected $HttpRequest;
	protected $HttpResponse;
	protected $action;
	protected $services = [];
	protected $page;
	protected $components = [];

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse, $action)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->action = $action;
		$this->init();
	}

	abstract protected function init();

	protected function initServices(array $services)
	{
		foreach ($services as $service_name => $service_class) {
			$service_class = "\Model\Service\\{$service_class}";
			$this->services[$service_name] = new $service_class();
		}
	}

	protected function initPage()
	{
		$this->page = new Page;
	}

	protected function initComponents(array $components)
	{
		foreach ($components as $component_name => $component_view) {
			$this->components[$component_name] = new Component($component_view);
		}
	}

	protected function getComponent($name)
	{
		return $this->components[$name];
	}

	protected function getService($name)
	{
		return $this->services[$name];
	}

	public function run()
	{
		$method = $this->action;
		$this->$method();
	}
}
