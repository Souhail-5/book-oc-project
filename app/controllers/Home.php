<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Page;
use \QFram\Component;
use \Model\Service;

/**
* Home Controller
*/
class Home extends Controller
{
	protected $episodes_service;
	protected $comments_service;

	protected function setServices()
	{
		$this->episodes_service = new Service\Episodes;
		$this->comments_service = new Service\Comments;
	}

	public function show()
	{
		$page = new Page();
		$page->title = "Billet simple pour l'Alaska";
		$page->bodyId = "home";

		$episodes_template = new Component('episodes');
		$episodes_template->episodes = $this->episodes_service->getEpisodes();

		$page->view = $episodes_template->render();

		echo $page->render();
	}
}
