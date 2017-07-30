<?php
namespace QFram;

/**
* Controller Base
*/
abstract class Controller
{
	protected $HttpRequest;
	protected $HttpResponse;
	protected $action;
	protected $user;
	protected $services = [];
	protected $page;
	protected $components = [];

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse, $action)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->action = $action;
		$this->user = new User;
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
		$this->page->user = $this->user;
	}

	protected function initComponents(array $components)
	{
		foreach ($components as $component_name => $component_view) {
			$this->components[$component_name] = new Component($component_view);
			$this->components[$component_name]->user = $this->user;
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
