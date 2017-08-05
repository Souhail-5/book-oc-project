<?php
namespace Model\Service;

use \Model\Object;
use \Model\Mapper;

/**
* Users service
*/
class Users
{
	protected $users;

	public function __construct()
	{
		$this->users = new Mapper\Users;
	}

	public function setNewUser(array $data=[])
	{
		return new Object\User($data);
	}

	public function signInByEmail(Object\User $user)
	{
		$error = [];

		if (!filter_var($user->email(), FILTER_VALIDATE_EMAIL))
			$error[] = "L'email doit être sous la forme de mon@exemple.com";
		if (!preg_match('#^(.){4,}$#', $user->password()))
			$error[] = "Le mot de passe doit contenir au moins 4 caractères.";

		if (!empty($error)) throw new \Exception(implode('<br>', $error));

		try {
			return $this->users->signInByEmail($user);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
