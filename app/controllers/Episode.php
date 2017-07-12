<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Page;
use \QFram\Component;
use \Model\Mapper;
use \Model\Object;

/**
* Episode Controller
*/
class Episode extends Controller
{
	public function show()
	{
		$page = new Page;
		$page->title = "Nom de l'épisode";
		$page->addStylesheets(['/assets/css/episode.css']);
		$page->addScripts([
			'src' => 'https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i',
			'execute' => '',
		]);
		$page->addCustomBtmScripts(["tinymce.init({ selector: '#episode-content' });"]);

		$db = new \PDO('mysql:host=localhost;dbname=project3', 'root', 'root');

		$episodes_mapper = new Mapper\Episodes($db);

		$episodeTemplate = new Component('episode');
		$episodeTemplate->user = true;
		$episodeTemplate->episode = $episodes_mapper->get($this->HTTPRequest->GETData('number'));

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}

	public function newEpisode()
	{
		$page = new Page;
		$page->title = "Nouvel épisode";
		$page->addStylesheets(['/assets/css/episode.css']);
		$page->addScripts([
			'src' => 'https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i',
			'execute' => '',
		]);
		$page->addCustomBtmScripts(["tinymce.init({ selector: '#episode-content' });"]);

		$episode_object = new Object\Episode;

		$episodeTemplate = new Component('episode');
		$episodeTemplate->user = true;
		$episodeTemplate->episode = $episode_object;

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}
}
