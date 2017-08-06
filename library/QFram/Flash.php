<?php
namespace QFram;

/**
* Flash Service
*/
class Flash
{
	use \QFram\Helper\Utility;

	protected $type;
	protected $title;
	protected $text;

	public function __construct()
	{
		$this->type = isset($_SESSION['flash']['type']) ? $_SESSION['flash']['type'] : null;
		$this->title = isset($_SESSION['flash']['title']) ? $_SESSION['flash']['title'] : null;
		$this->text = isset($_SESSION['flash']['text']) ? $_SESSION['flash']['text'] : null;
	}

	public function exist()
	{
		return isset($_SESSION['flash']);
	}

	public function get($property) {
		unset($_SESSION['flash']);
		return $this->$property;
	}

	public function setType($value)
	{
		$_SESSION['flash']['type'] = $value;
		$this->type = $_SESSION['flash']['type'];
	}

	public function setTitle($value)
	{
		$_SESSION['flash']['title'] = $value;
		$this->title = $_SESSION['flash']['title'];
	}

	public function setText($value)
	{
		$_SESSION['flash']['text'] = $value;
		$this->text = $_SESSION['flash']['text'];
	}
}
