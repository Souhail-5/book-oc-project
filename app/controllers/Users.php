<?php
namespace Controller;

use \QFram\Helper\PDOFactory;
use \QFram\Router;
use \QFram\Controller;

/**
* Users Controller
*/
class Users extends Controller
{
	protected $db;

	protected function init()
	{
		$this->initServices([
			'users' => 'Users',
		]);
		$this->initPage();
		$this->initComponents([
			'sign-in-form' => 'sign-in-form',
		]);
	}

	public function render()
	{
		$this->page->title = "Billet simple pour l'Alaska | Se connecter";
		$this->page->bodyId = "sign-in";
		$this->page->view = $this->getComponent('sign-in-form')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function showSignIn()
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
		try {
			$user = $this->getService('users')->signInByEmail($this->getService('users')->setNewUser([
				'email' => $this->HttpRequest->POSTData('email'),
				'password' => $this->HttpRequest->POSTData('password'),
			]));
		} catch (\Exception $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Aie !',
				'text' => 'Les identifiants sont incorrects.',
			]);
			$this->HttpResponse->redirect(Router::genPath('sign-in'));
		}
		$this->user->setAuthenticated();
		$this->user->setAttribute('display_name', $user->displayName());
		$this->HttpResponse->redirect(Router::genPath('episodes'));
	}

	public function signOut()
	{
		$this->user->setAuthenticated(false);
	}
}