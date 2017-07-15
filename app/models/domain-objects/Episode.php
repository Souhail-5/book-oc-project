<?php
namespace Model\Object;

/**
* Episode Model
*/
class Episode
{
	protected $id;
	protected $number;
	protected $part;
	protected $title;
	protected $text;
	protected $publishDatetime;
	protected $modificationDatetime;
	protected $nbrComments;
	protected $status;
	protected $slug;

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
	public function number() { return $this->number; }
	public function part() { return $this->part; }
	public function title() { return $this->title; }
	public function text() { return $this->text; }
	public function publishDatetime() { return $this->publishDatetime; }
	public function modificationDatetime() { return $this->modificationDatetime; }
	public function nbrComments() { return $this->nbrComments; }
	public function status() { return $this->status; }
	public function slug() { return $this->slug; }

	protected function setId($value)
	{
		$this->id = $value;
	}

	public function setNumber($value)
	{
		$this->number = $value;
	}

	public function setPart($value)
	{
		$this->part = $value;
	}

	public function setTitle($value)
	{
		$this->title = $value;
	}

	public function setText($value)
	{
		$this->text = $value;
	}

	public function setPublishDatetime($value)
	{
		$this->publishDatetime = $value;
	}

	public function setModificationDatetime($value)
	{
		$this->modificationDatetime = $value;
	}

	public function setNbrComments($value)
	{
		$this->nbrComments = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

	public function setSlug($value)
	{
		$this->slug = $value;
	}

}
