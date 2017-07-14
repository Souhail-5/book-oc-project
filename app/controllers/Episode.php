<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Page;
use \QFram\Component;
use \Model\Mapper;
use \Model\Service;

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
		$page->addCustomBtmScripts(["tinymce.init({
			selector: '.editable-content',
			inline: true,
			theme: 'inlite'
		});"]);

		$episodes_service = new Service\Episodes;

		$episodeTemplate = new Component('episode');
		$episodeTemplate->user = true;
		$episodeTemplate->episode = $episodes_service->getById($this->HTTPRequest->GETData('number'));

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}

	public function newEpisode()
	{
		$episodes_service = new Service\Episodes;

		if ($this->HTTPRequest->method() == 'POST') {
			$episodes_service->add($_POST);
		}

		$page = new Page;
		$page->title = "Nouvel épisode";
		$page->addStylesheets(['/assets/css/episode.css']);
		$page->addScripts([
			'src' => 'https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i',
			'execute' => '',
		]);
		$page->addCustomBtmScripts(["tinymce.init({
			selector: '.editable-content',
			inline: true,
			theme: 'inlite',
			selection_toolbar: 'bold italic | blockquote h2 h3',
			insert_toolbar: '',
			branding: false
		});"]);

		$episodeTemplate = new Component('episode');
		$episodeTemplate->user = true;
		$episodeTemplate->episode = $episodes_service->blank();

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}
}
