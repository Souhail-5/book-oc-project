<?php
/**
* Episode Model
*/
class EpisodeModel
{
	protected $id;
	protected $number;
	protected $title;
	protected $text;
	protected $publishDate;
	protected $draftDate;
	protected $nbrComments;
	protected $status;

	public function __construct(array $data = array())
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
	public function title() { return $this->title; }
	public function text() { return $this->text; }
	public function publishDate() { return $this->publishDate; }
	public function draftDate() { return $this->draftDate; }
	public function nbrComments() { return $this->nbrComments; }
	public function status() { return $this->status; }

	public function setNumber($value)
	{
		$this->number = $value;
	}

	public function setTitle($value)
	{
		$this->title = $value;
	}

	public function setText($value)
	{
		$this->text = $value;
	}

	public function setPublishDate($value)
	{
		$this->publishDate = $value;
	}

	public function setDraftDate($value)
	{
		$this->draftDate = $value;
	}

	public function setNbrComments($value)
	{
		$this->nbrComments = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

}
