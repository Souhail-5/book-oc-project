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
		$episodes_service = new Service\Episodes;
		$episodeTemplate = new Component('episode');
		$episodeTemplate->user = true;
		$episodeTemplate->episode = $episodes_service->getEpisode(
			$this->HttpRequest->GETData('number'),
			$this->HttpRequest->GETData('slug')
		);

		if ($this->HttpRequest->method() == 'POST') {
			try {
				$q = $episodes_service->update($_POST);
				$episodeTemplate->episode = $episodes_service->getEpisode(
					$q->number(),
					$q->slug()
				);
			} catch (\Exception $e) {
				$episode_template->episode = $episodes_service->getNewEpisode([
					'number' => $this->HttpRequest->POSTData('mce_0'),
					'part' => $this->HttpRequest->POSTData('mce_1'),
					'title' => $this->HttpRequest->POSTData('mce_2'),
					'text' => $this->HttpRequest->POSTData('mce_3'),
				]);
				echo $e->getMessage();
			}
		}

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

		$page->view = $episodeTemplate->render();

		echo $page->render();
	}

	public function newEpisode()
	{
		$episodes_service = new Service\Episodes;
		$episode_template = new Component('episode');
		$episode_template->user = true;
		$episode_template->episode = $episodes_service->getNewEpisode();

		if ($this->HttpRequest->method() == 'POST') {
			try {
				$episodes_service->add($_POST);
			} catch (\Exception $e) {
				$episode_template->episode = $episodes_service->getNewEpisode([
					'number' => $this->HttpRequest->POSTData('mce_0'),
					'part' => $this->HttpRequest->POSTData('mce_1'),
					'title' => $this->HttpRequest->POSTData('mce_2'),
					'text' => $this->HttpRequest->POSTData('mce_3'),
				]);
				echo $e->getMessage();
			}
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

		$page->view = $episode_template->render();

		echo $page->render();
	}
}
