<?php
namespace QFram;

use \QFram\Router;

/**
* Controller Base
*/
abstract class Controller
{
	protected $HttpRequest;
	protected $HttpResponse;
	protected $action;
	protected $user;
	protected $flash;
	protected $services = [];
	protected $page;
	protected $components = [];
	protected $apis_configs;

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse, $action)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->action = $action;
		$this->user = new User;
		$this->flash = new Flash;
		$this->apis_configs = json_decode(file_get_contents(__DIR__.'/../../app/config/apis.json'), true);
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
		$this->page->flash = $this->flash;
	}

	protected function initComponents(array $components)
	{
		foreach ($components as $component_name => $component_view) {
			$this->components[$component_name] = new Component($component_view);
			$this->components[$component_name]->user = $this->user;
			$this->components[$component_name]->flash = $this->flash;
		}
	}

	protected function signOut()
	{
		$this->user->setAuthenticated(false);
		$this->HttpResponse->redirect(Router::genPath('episodes'));
	}

	protected function getComponent($name)
	{
		return $this->components[$name];
	}

	protected function getService($name)
	{
		return $this->services[$name];
	}

	protected function getApi($name)
	{
		return $this->apis_configs[$name];
	}

	public function run()
	{
		$method = $this->action;
		$this->$method();
	}
}
