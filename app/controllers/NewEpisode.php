<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Router;

/**
* New Episode Controller
*/
class NewEpisode extends Controller
{
	protected function init()
	{
		// To-do: add verify authentication

		$this->initServices([
			'episodes' => 'Episodes',
			'comments' => 'Comments',
		]);
		$this->initPage();
		$this->initComponents([
			'new-episode' => 'new-episode',
		]);
	}

	public function render()
	{
		$this->page->title = "Nouvel épisode";
		$this->page->bodyId = "episode";
		$this->page->addScripts([
			'<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i"></script>',
		]);
		$this->page->addCustomBtmScripts(["tinymce.init({
			selector: '.editable-content',
			inline: true,
			theme: 'inlite',
			selection_toolbar: 'bold italic | blockquote h2 h3',
			insert_toolbar: '',
			branding: false
		});"]);

		$this->page->view = $this->getComponent('new-episode')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function show()
	{
		$this->getComponent('new-episode')->episode = $this->getService('episodes')->setNewEpisode();

		$this->render();
	}

	public function newEpisode()
	{
		$this->getComponent('new-episode')->episode = $this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->POSTData('mce_0'),
			'part' => $this->HttpRequest->POSTData('mce_1'),
			'title' => $this->HttpRequest->POSTData('mce_2'),
			'text' => $this->HttpRequest->POSTData('mce_3'),
		]);

		try {
			$this->getService('episodes')->add($this->getComponent('new-episode')->episode);

			$this->getComponent('new-episode')->episode = $this->getService('episodes')->getEpisode($this->getComponent('new-episode')->episode);

			$this->HttpResponse->redirect(Router::getPath('episode', [$this->getComponent('new-episode')->episode->number(), $this->getComponent('new-episode')->episode->slug()]));
		} catch (\Exception $e) {
			echo $e->getMessage();
			$this->render();
		}
	}
}
