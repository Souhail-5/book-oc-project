<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Router;
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
		$episode_template = new Component('episode');
		$episode_template->user = true;
		$episode_template->episode = $episodes_service->getEpisode($episodes_service->setNewEpisode([
			'number' => $this->HttpRequest->GETData('number'),
			'slug' => $this->HttpRequest->GETData('slug')
		]));

		if ($this->HttpRequest->method() == 'POST') {
			try {
				$episode_template->episode->setNumber($_POST['mce_0']);
				$episode_template->episode->setPart($_POST['mce_1']);
				$episode_template->episode->setTitle($_POST['mce_2']);
				$episode_template->episode->setText($_POST['mce_3']);

				if ($_POST['action'] == 'update') $episodes_service->update($episode_template->episode);
				if ($_POST['action'] == 'delete') $episodes_service->delete($episode_template->episode);

				$episode_template->episode = $episodes_service->getEpisode($episode_template->episode);

				if ($_POST['action'] == 'update') $this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
				if ($_POST['action'] == 'delete') $this->HttpResponse->redirect(Router::getPath('root'));
			} catch (\Exception $e) {
				$episode_template->episode = $episodes_service->setNewEpisode([
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
		$page->addScripts([
			'<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i"></script>'
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

	public function newEpisode()
	{
		$episodes_service = new Service\Episodes;
		$episode_template = new Component('episode');
		$episode_template->user = true;
		$episode_template->episode = $episodes_service->setNewEpisode();

		if ($this->HttpRequest->method() == 'POST') {
			try {
				$episode_template->episode->setNumber($_POST['mce_0']);
				$episode_template->episode->setPart($_POST['mce_1']);
				$episode_template->episode->setTitle($_POST['mce_2']);
				$episode_template->episode->setText($_POST['mce_3']);

				$episodes_service->add($episode_template->episode);

				$episode_template->episode = $episodes_service->getEpisode($episode_template->episode);

				$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
			} catch (\Exception $e) {
				$episode_template->episode = $episodes_service->setNewEpisode([
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
		$page->addScripts([
			'<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i"></script>',
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
