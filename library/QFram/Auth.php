<?php
namespace QFram;

use QFram\Helper\PDOFactory;
use QFram\Router;

/**
* Auth Controller
*/
class Auth extends Controller
{
	protected $db;

	protected function init()
	{
		$this->db = PDOFactory::getMysqlConnexion();

		$this->initPage();
		$this->initComponents([
			'sign-in-form' => 'sign-in-form',
		]);
	}

	public function render()
	{
		$this->page->title = "Billet simple pour l'Alaska | Se connecter";
		$this->page->bodyId = "auth";
		$this->page->view = $this->getComponent('sign-in-form')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function show()
	{
		if ($this->user->isAuthenticated()) {
			$this->user->setFlash("Bonjour {$this->user->getAttribute('display_name')}, vous êtes déjà connecté.");
			$this->HttpResponse->redirect(Router::genPath('episodes'));
		}

		$this->render();
	}

	public function signIn()
	{
		$q = $this->db->prepare('
			SELECT id, email, display_name, password
			FROM users
			WHERE email=:email
			LIMIT 1
		');

		$q->bindValue(':email', $this->HttpRequest->POSTData('email'));

		$q->execute();

		$data = $q->fetch(\PDO::FETCH_ASSOC);

		if (!$data || !password_verify($this->HttpRequest->POSTData('password'), $data['password'])) {
			$this->user->setFlash('Les identifiants sont incorrectes.');
			$this->HttpResponse->redirect(Router::genPath('sign-in'));
		}

		$this->user->setAuthenticated();
		$this->user->setAttribute('display_name', $data['display_name']);
		$this->HttpResponse->redirect(Router::genPath('episodes'));
	}

	public function signOut()
	{
		$this->user->setAuthenticated(false);
	}

	public function signUp()
	{
		$q = $this->db->prepare('
			INSERT INTO users (email, display_name, password)
			VALUES (:email, :display_name, :password)
		');

		$q->bindValue(':email', 'demo@demo.com');
		$q->bindValue(':display_name', 'Jean');
		$q->bindValue(':password', password_hash('demo', PASSWORD_DEFAULT));

		$q->execute();
	}
}
