<?php
namespace Controller;

use \QFram\HTTPRequest;

/**
* Controller Base
*/
abstract class Controller
{
	protected $HTTPRequest;
	protected $action;

	public function __construct(HTTPRequest $HTTPRequest, $action)
	{
		$this->HTTPRequest = $HTTPRequest;
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
