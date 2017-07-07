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
	protected $publish_datetime;
	protected $draft_datetime;
	protected $nbr_comments;
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
	public function publish_datetime() { return $this->publish_datetime; }
	public function draft_datetime() { return $this->draft_datetime; }
	public function nbr_comments() { return $this->nbr_comments; }
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

	public function setPublish_datetime($value)
	{
		$this->publish_datetime = $value;
	}

	public function setDraft_datetime($value)
	{
		$this->draft_datetime = $value;
	}

	public function setNbr_comments($value)
	{
		$this->nbr_comments = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

}
