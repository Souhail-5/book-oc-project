<?php
namespace Controller;

use \QFram\HttpRequest;
use \QFram\HttpResponse;

/**
* Controller Base
*/
// To-do: Move to /library/QFram
abstract class Controller
{
	protected $HttpRequest;
	protected $HttpResponse;
	protected $action;

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse, $action)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->action = $action;
		$this->setServices();
	}

	abstract protected function setServices();

	public function run()
	{
		$method = $this->action;
		$this->$method();
	}
}
