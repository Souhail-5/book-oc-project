<?php
namespace Controller;

use \QFram\HttpRequest;
use \QFram\HttpResponse;

/**
* Controller Base
*/
abstract class Controller
{
	protected $HttpRequest;
	protected $HttpResponse;
	protected $action;

	public function __construct(HttpRequest $HttpRequest, HttpResponse $HttpResponse, $action)
	{
		$this->HttpRequest = $HttpRequest;
		$this->HttpResponse = $HttpResponse;
		$this->setAction($action);
	}

	public function setAction($action)
	{
		$this->action = $action;
	}

	public function run()
	{
		$method = $this->action;
		$this->$method();
	}
}
