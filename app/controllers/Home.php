<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Page;
use \QFram\Component;
use \Model\Mapper;

/**
* Home Controller
*/
class Home extends Controller
{
	public function show()
	{
		$page = new Page();
		$page->title = "Billet simple pour l'Alaska";

		$db = new \PDO('mysql:host=localhost;dbname=project3', 'root', 'root');

		$episodes_manager = new Mapper\Episodes($db);

		$episodesView = new Component('episodes');
		$episodesView->episodes = $episodes_manager->getList();

		$page->view = $episodesView->render();

		echo $page->render();
	}
}
