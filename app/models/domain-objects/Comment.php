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
	protected $nbrSignals;

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

	public function id() { return $this->id; }
	public function episodeId() { return $this->episodeId; }
	public function name() { return $this->name; }
	public function email() { return $this->email; }
	public function text() { return $this->text; }
	public function publishDatetime() { return $this->publishDatetime; }
	public function nbrSignals() { return $this->nbrSignals; }

	public function setId($value)
	{
		$this->id = $value;
	}

	public function setEpisodeId($value)
	{
		$this->episodeId = $value;
	}

	public function setName($value)
	{
		$this->name = $value;
	}

	public function setEmail($value)
	{
		$this->email = $value;
	}

	public function setText($value)
	{
		$this->text = $value;
	}

	public function setPublishDatetime($value)
	{
		$this->publishDatetime = $value;
	}

	public function setNbrSignals($value)
	{
		$this->nbrSignals = $value;
	}
}
