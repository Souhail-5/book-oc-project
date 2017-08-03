<?php
namespace Model\Object;

/**
* Comment Model
*/
class Comment
{
	protected $validPatterns;
	protected $id;
	protected $episodeId;
	protected $name;
	protected $email;
	protected $text;
	protected $publishDatetime;
	protected $nbrSignals;
	protected $status;
	protected $approved;
	protected $trash;

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

	public function isValid($property)
	{
		if (!isset($this->validPatterns[$property])) {
			return true;
		}
		return preg_match($this->validPatterns[$property], $this->$property);
	}

	public function validPatterns() { return $this->validPatterns; }
	public function id() { return $this->id; }
	public function episodeId() { return $this->episodeId; }
	public function name() { return $this->name; }
	public function email() { return $this->email; }
	public function text() { return $this->text; }
	public function publishDatetime() { return $this->publishDatetime; }
	public function nbrSignals() { return $this->nbrSignals; }
	public function status() { return $this->status; }
	public function approved() { return $this->approved; }
	public function trash() { return $this->trash; }

	public function setValidPatterns(array $validPatterns)
	{
		array_merge($this->validPatterns, $validPatterns);
	}

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
		$this->setValidPatterns([
			'name' => [
				'regex' => '#^[a-zA-Z ]{5,50}$#',
				'message' => 'Le nom ne doit comporter que des lettres et espaces. Sa longueur doit être comprise entre 5 et 50 caractères.',
			]
		]);
		$this->name = $value;
	}

	public function setEmail($value)
	{
		$this->setValidPatterns([
			'name' => [
				'regex' => '#^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$#',
				'message' => "L'email doit être sous la forme de mon@exemple.com",
			]
		]);
		$this->email = $value;
	}

	public function setText($value)
	{
		$this->setValidPatterns([
			'name' => [
				'regex' => '#^(.){140,1400}$#',
				'message' => 'La longueur du commentaire doit être comprise entre 140 et 1400 caractères.',
			]
		]);
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
