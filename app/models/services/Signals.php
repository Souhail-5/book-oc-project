<?php
namespace Model\Service;

use \Model\Object;
use \Model\Mapper;

/**
* Signals service
*/
class Signals
{
	protected $signals;

	public function __construct()
	{
		$this->signals = new Mapper\Signals;
	}

	public function setNewSignal(array $data=[])
	{
		return new Object\Signal($data);
	}

	public function add(Object\Signal $signal)
	{
		return $this->signals->add($signal);
	}

	public function hasAlreadySignaledComment(Object\Signal $signal)
	{
		return $this->signals->hasAlreadySignaledComment($signal);
	}
}
