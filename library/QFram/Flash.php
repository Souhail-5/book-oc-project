<?php
namespace QFram;

/**
* Flash Service
*/
class Flash
{
	protected $type;
	protected $title;
	protected $text;

	public function __construct()
	{
		$this->type = isset($_SESSION['flash']['type']) ? $_SESSION['flash']['type'] : null;
		$this->title = isset($_SESSION['flash']['title']) ? $_SESSION['flash']['title'] : null;
		$this->text = isset($_SESSION['flash']['text']) ? $_SESSION['flash']['text'] : null;
	}

	// To-do: transform it to a Trait
	public function hydrate(array $data)
	{
		foreach ($data as $property => $value) {
			$method = 'set'.ucfirst($property);
			if (method_exists($this, $method)) $this->$method($value);
		}
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
