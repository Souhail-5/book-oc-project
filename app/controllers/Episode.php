<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Template;
use \Model\Mapper;

/**
* Episode Controller
*/
class Episode extends Controller
{
	public function show()
	{
		$page = new Template('page');
		$page->language = "fr";
		$page->scripts = array(
			'#',
		);

		$page->title = "Nom de l'épisode";
		$page->stylesheets = array(
			'https://fonts.googleapis.com/css?family=Inconsolata:700|Lato:300,400|Merriweather:300',
			'/vendors/font-awesome-4.7.0/css/font-awesome.min.css',
			'/vendors/normalize/normalize.css',
			'/assets/css/episode.css',
		);

		$db = new \PDO('mysql:host=localhost;dbname=project3', 'root', 'root');

		$episodes_mapper = new Mapper\Episodes($db);

		$episodeTemplate = new Template('episode');
		$episodeTemplate->episode = $episodes_mapper->get($this->HTTPRequest->GETData('number'));

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}
}
