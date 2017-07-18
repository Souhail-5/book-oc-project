<?php
namespace Model\Object;

/**
* Comment Model
*/
class Comment
{
	protected $id;
	protected $episodeId;
	protected $name;
	protected $email;
	protected $text;
	protected $publishDatetime;
	protected $signal;

	public function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	// To-do: transform it to a Trait
	public function hydrate(array $data)
	{
		foreach ($data as $property => $value) {
			$method = 'set'.ucfirst($property);
			if (method_exists($this, $method)) $this->$method($value);
		}
	}

	public function id() { return $this->id; };
	public function episodeId() { return $this->episodeId; };
	public function name() { return $this->name; };
	public function email() { return $this->email; };
	public function text() { return $this->text; };
	public function publishDatetime() { return $this->publishDatetime; };
	public function signal() { return $this->signal; };

	protected function setId($value)
	{
		$this->id = $value;
	}

	protected function setEpisodeId($value)
	{
		$this->episodeId = $value;
	}

	protected function setName($value)
	{
		$this->name = $value;
	}

	protected function setEmail($value)
	{
		$this->email = $value;
	}

	protected function setText($value)
	{
		$this->text = $value;
	}

	protected function setPublishDatetime($value)
	{
		$this->publishDatetime = $value;
	}

	protected function setSignal($value)
	{
		$this->signal = $value;
	}
}
