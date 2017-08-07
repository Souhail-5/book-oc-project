<?php
namespace Model\Object;

/**
* Signal Model
*/
class Signal
{
	use \QFram\Helper\Utility;

	protected $id;
	protected $commentId;
	protected $ipAddress;

	public function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	public function id() { return $this->id; }
	public function commentId() { return $this->commentId; }
	public function ipAddress() { return $this->ipAddress; }

	public function setId($value)
	{
		$this->id = $value;
	}

	public function setCommentId($value)
	{
		$this->commentId = $value;
	}

	public function setIpAddress($value)
	{
		$this->ipAddress = $value;
	}
}
