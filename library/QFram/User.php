<?php
namespace QFram;

/**
* User Service
*/
class User
{
	private function signOut()
	{
		$_SESSION = array();
		if (ini_get('session.use_cookies')) {
			$params = session_get_cookie_params();
			setcookie(
				session_name(), '', time() - 42000,
				$params['path'], $params['domain'],
				$params['secure'], $params['httponly']
			);
		}
		session_destroy();
	}

	public function getAttribute($attr)
	{
		return isset($_SESSION[$attr]) ? $_SESSION[$attr] : null;
	}

	public function isAuthenticated()
	{
		return isset($_SESSION['auth']) && $_SESSION['auth'] === true;
	}

	public function setAttribute($attr, $value)
	{
		$_SESSION[$attr] = $value;
	}

	public function setAuthenticated($authenticated = true)
	{
		if (!is_bool($authenticated))
		{
			throw new \InvalidArgumentException('La valeur spécifiée à la méthode User::setAuthenticated() doit être un boolean');
		}

		$authenticated ? $_SESSION['auth'] = $authenticated : $this->signOut();
	}
}
