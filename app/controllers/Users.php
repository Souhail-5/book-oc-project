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
			'episodes' => 'Episodes',
		]);
		$this->initPage();
		$this->initComponents([
			'home' => 'home',
			'sign-in-form' => 'sign-in-form',
			'403' => '403',
			'404' => '404',
			'mentions-legales' => 'mentions-legales',
		]);
		$this->hasFirstEpisode();
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

	public function show404()
	{
		$this->HttpResponse->addHeader($_SERVER["SERVER_PROTOCOL"].' 404 Not Found');
		$this->page->title = "Billet simple pour l'Alaska | Page non trouvée";
		$this->page->bodyId = "not-found-404";
		$this->page->view = $this->getComponent('404')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function show403()
	{
		$this->HttpResponse->addHeader($_SERVER["SERVER_PROTOCOL"].' 403 Forbidden');
		$this->page->title = "Billet simple pour l'Alaska | Accès non autorisé";
		$this->page->bodyId = "access-denied-403";
		$this->page->view = $this->getComponent('403')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function showLegal()
	{
		$this->page->title = "Billet simple pour l'Alaska | Mentions légales";
		$this->page->bodyId = "legal";
		$this->getComponent('home')->view = $this->getComponent('mentions-legales')->render();
		$this->page->view = $this->getComponent('home')->render();

		$this->HttpResponse->send($this->page->render());
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

	public function hasFirstEpisode()
	{
		try {
			$this->getService('episodes')->getFirst();
			$this->getComponent('home')->hasFirstEpisode = true;
		} catch (\Exception $e) {
			$this->getComponent('home')->hasFirstEpisode = false;
		}
	}
}
