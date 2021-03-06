<?php
namespace Model\Object;

/**
* Episode Model
*/
class Episode
{
	use \QFram\Helper\Utility;

	protected $id;
	protected $number;
	protected $part;
	protected $title;
	protected $text;
	protected $publishDatetime;
	protected $modificationDatetime;
	protected $nbrComments;
	protected $slug;
	protected $status;
	protected $trash;

	public function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	public function id() { return $this->id; }
	public function number() { return $this->number; }
	public function part() { return $this->part; }
	public function title() { return $this->title; }
	public function text() { return $this->text; }
	public function publishDatetime() { return $this->publishDatetime; }
	public function modificationDatetime() { return $this->modificationDatetime; }
	public function nbrComments() { return $this->nbrComments; }
	public function slug() { return $this->slug; }
	public function status() { return $this->status; }
	public function trash() { return $this->trash; }

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

	public function setSlug($value)
	{
		$this->slug = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

	public function setTrash($value)
	{
		$this->trash = $value;
	}

}
