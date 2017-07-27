<?php
namespace Controller;

use \Controller\Controller;

/**
* Episodes Controller
*/
class Episodes extends Controller
{
	protected function init()
	{
		$this->initServices([
			'episodes' => 'Episodes',
		]);
		$this->initPage();
		$this->initComponents([
			'home' => 'home',
			'episodes-list' => 'episodes-list',
		]);
	}

	public function render()
	{
		$this->page->title = "Billet simple pour l'Alaska";
		$this->page->bodyId = "home";
		$this->page->view = $this->getComponent('home')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function showAllPublish()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllPublish();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->render();
	}

	public function showAllDraft()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllDraft();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->render();
	}

	public function showAllTrash()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllTrash();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->render();
	}
}
