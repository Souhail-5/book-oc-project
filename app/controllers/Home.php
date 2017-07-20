<?php
namespace Controller;

use \Controller\Controller;

/**
* Home Controller
*/
class Home extends Controller
{
	protected function init()
	{
		$this->initServices([
			'episodes' => 'Episodes',
		]);
		$this->initPage();
		$this->initComponents([
			'episodes' => 'episodes',
		]);
	}

	public function show()
	{
		$this->page->title = "Billet simple pour l'Alaska";
		$this->page->bodyId = "home";

		$episodes_view = $this->getComponent('episodes');
		$episodes_view->episodes = $this->getService('episodes')->getEpisodes();

		$this->page->view = $episodes_view->render();

		echo $this->page->render();
	}
}
