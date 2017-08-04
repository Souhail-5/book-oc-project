<?php
namespace Controller;

use \QFram\Helper\PDOFactory;
use \QFram\Router;
use \QFram\Controller;

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
			$this->flash->hydrate([
				'type' => 'info',
				'title' => '',
				'text' => "Bonjour {$this->user->getAttribute('display_name')}, vous êtes déjà connecté.",
			]);
			$this->HttpResponse->redirect(Router::genPath('episodes'));
		}

		$this->render();
	}

	public function isAuthenticated()
	{
		if (!$this->user->isAuthenticated()) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Oups !',
				'text' => "Vous devez être connecté pour accéder à cette page.",
			]);
			$this->HttpResponse->redirect(Router::genPath('sign-in'));
		}
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
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Aie !',
				'text' => 'Les identifiants sont incorrectes.',
			]);
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
}
