<?php
namespace Model\Mapper;

use \Model\Object\User;
use \QFram\Helper\PDOFactory;

/**
* Users Manager
*/
class Users
{
	protected $db;

	function __construct()
	{
		$this->db = PDOFactory::getConnexion('main');
	}

	public function signInByEmail(User $user)
	{
		$q = $this->db->prepare('
			SELECT id, email, display_name, password
			FROM users
			WHERE email=:email
			LIMIT 1
		');

		$q->bindValue(':email', $user->email());

		$q->execute();

		$data = $q->fetch(\PDO::FETCH_ASSOC);

		if (!$data || !password_verify($user->password(), $data['password'])) throw new \Exception("Authentification impossible.");

		$map = [
			'id' => $data['id'],
			'email' => $data['email'],
			'displayName' => $data['display_name'],
			'password' => $data['password'],
		];

		return new User($map);
	}
}
