<?php
namespace Model\Object;

/**
* User Model
*/
class User
{
	use \QFram\Helper\Utility;

	protected $id;
	protected $email;
	protected $displayName;
	protected $password;

	public function __construct(array $data = [])
	{
		$this->hydrate($data);
	}

	public function id() { return $this->id; }
	public function email() { return $this->email; }
	public function displayName() { return $this->displayName; }
	public function password() { return $this->password; }

	public function setId($value)
	{
		$this->id = $value;
	}

	public function setDisplayName($value)
	{
		$this->displayName = $value;
	}

	public function setEmail($value)
	{
		$this->email = $value;
	}

	public function setPassword($value)
	{
		$this->password = $value;
	}
}
