<?php
namespace Model\Object;

/**
* User Model
*/
class User
{
	protected $id;
	protected $email;
	protected $displayName;
	protected $password;

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
