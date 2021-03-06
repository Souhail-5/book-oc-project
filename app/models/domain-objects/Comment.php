<?php
namespace Model\Object;

/**
* Comment Model
*/
class Comment
{
	use \QFram\Helper\Utility;

	protected $id;
	protected $episodeId;
	protected $name;
	protected $email;
	protected $text;
	protected $publishDatetime;
	protected $modificationDatetime;
	protected $nbrSignals;
	protected $status;
	protected $approved;
	protected $trash;

	public function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	public function id() { return $this->id; }
	public function episodeId() { return $this->episodeId; }
	public function name() { return $this->name; }
	public function email() { return $this->email; }
	public function text() { return $this->text; }
	public function publishDatetime() { return $this->publishDatetime; }
	public function modificationDatetime() { return $this->modificationDatetime; }
	public function nbrSignals() { return $this->nbrSignals; }
	public function status() { return $this->status; }
	public function approved() { return $this->approved; }
	public function trash() { return $this->trash; }

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

	public function setModificationDatetime($value)
	{
		$this->modificationDatetime = $value;
	}

	public function setNbrSignals($value)
	{
		$this->nbrSignals = $value;
	}

	public function setStatus($value)
	{
		$this->status = $value;
	}

	public function setApproved($value)
	{
		$this->approved = $value;
	}

	public function setTrash($value)
	{
		$this->trash = $value;
	}
}
