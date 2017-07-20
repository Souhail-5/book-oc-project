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
	protected $episodes_service;
	protected $comments_service;

	protected function setServices()
	{
		$this->episodes_service = new Service\Episodes;
		$this->comments_service = new Service\Comments;
	}

	public function show()
	{
		$episode_template = new Component('episode');
		$new_comment_form = new Component('new-comment-form');
		$episode_template->new_comment_form = $new_comment_form->render();
		$episode_template->user = true;
		$episode_template->episode = $this->episodes_service->getEpisode($this->episodes_service->setNewEpisode([
			'number' => $this->HttpRequest->GETData('number'),
			'slug' => $this->HttpRequest->GETData('slug')
		]));

		$page = new Page;
		$page->title = "Nom de l'épisode";
		$page->bodyId = "episode";
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

	public function updateEpisode()
	{
		$episode_template = new Component('episode');
		$episode_template->new_comment_form = false;
		$episode_template->user = true;
		$episode_template->episode = $this->episodes_service->getEpisode(
			$this->episodes_service->setNewEpisode(
				[
					'number' => $this->HttpRequest->GETData('number'),
					'slug' => $this->HttpRequest->GETData('slug')
				]
			)
		);
		$episode_template->episode->hydrate(
			[
				'number' => $this->HttpRequest->POSTData('mce_0'),
				'part' => $this->HttpRequest->POSTData('mce_1'),
				'title' => $this->HttpRequest->POSTData('mce_2'),
				'text' => $this->HttpRequest->POSTData('mce_3'),
			]
		);
		try {
			$this->episodes_service->update($episode_template->episode);

			// Puisque le slug peut changer en cas de changement du titre. Récupère le nouveau slug et redirige
			$episode_template->episode = $this->episodes_service->getEpisode($episode_template->episode);
			$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteEpisode()
	{
		$episode = $this->episodes_service->getEpisode(
			$this->episodes_service->setNewEpisode(
				[
					'number' => $this->HttpRequest->GETData('number'),
					'slug' => $this->HttpRequest->GETData('slug')
				]
			)
		);
		try {
			$this->episodes_service->delete($episode);
			$this->HttpResponse->redirect(Router::getPath('root'));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function newEpisodeComment()
	{
		$episode_template = new Component('episode');
		$new_comment_form = new Component('new-comment-form');
		$episode_template->new_comment_form = $new_comment_form->render();
		$episode_template->user = true;
		$episode_template->episode = $this->episodes_service->getEpisode($this->episodes_service->setNewEpisode([
			'number' => $this->HttpRequest->GETData('number'),
			'slug' => $this->HttpRequest->GETData('slug')
		]));
		try {
			$new_comment = $this->comments_service->setNewComment([
				'episodeId' => $episode_template->episode->id(),
				'name' => $this->HttpRequest->POSTData('comment-name'),
				'email' => $this->HttpRequest->POSTData('comment-email'),
				'text' => $this->HttpRequest->POSTData('comment-text'),
			]);
			$this->comments_service->add($new_comment);
			$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function newEpisode()
	{
		$episode_template = new Component('episode');
		$episode_template->new_comment_form = false;
		$episode_template->user = true;
		$episode_template->episode = $this->episodes_service->setNewEpisode();

		if ($this->HttpRequest->method() == 'POST') {
			try {
				$episode_template->episode->setNumber($this->HttpRequest->POSTData('mce_0'));
				$episode_template->episode->setPart($this->HttpRequest->POSTData('mce_1'));
				$episode_template->episode->setTitle($this->HttpRequest->POSTData('mce_2'));
				$episode_template->episode->setText($this->HttpRequest->POSTData('mce_3'));

				$this->episodes_service->add($episode_template->episode);

				$episode_template->episode = $this->episodes_service->getEpisode($episode_template->episode);

				$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
			} catch (\Exception $e) {
				$episode_template->episode = $this->episodes_service->setNewEpisode([
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
		$page->bodyId = "episode";
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
