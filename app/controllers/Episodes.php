<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Router;

/**
* Episodes Controller
*/
class Episodes extends Controller
{
	protected function init()
	{
		$this->initServices([
			'episodes' => 'Episodes',
			'comments' => 'Comments',
		]);
		$this->initPage();
		$this->initComponents([
			'home' => 'home',
			'episodes-list' => 'episodes-list',
			'episode-single' => 'episode-single',
			'new-comment-form' => 'new-comment-form',
			'episode-new' => 'episode-new',
		]);

		$this->page->addScripts([
			'<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i"></script>'
		]);
		$this->page->addCustomBtmScripts([
			"tinymce.init({
				selector: '.episode-title',
				inline: true,
				theme: 'inlite',
				selection_toolbar: '',
				insert_toolbar: '',
				branding: false
			});",
			"tinymce.init({
				selector: '.episode-text',
				inline: true,
				theme: 'inlite',
				selection_toolbar: 'bold italic | blockquote h2 h3',
				insert_toolbar: '',
				branding: false
			});",
		]);
	}

	public function renderHomePage()
	{
		$this->page->title = "Billet simple pour l'Alaska";
		$this->page->bodyId = "home";
		$this->page->view = $this->getComponent('home')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function renderSinglePage()
	{
		$this->page->title = "Billet simple pour l'Alaska | {$this->getComponent('episode-single')->episode->title()}";
		$this->page->bodyId = "episode-single";

		$this->page->view = $this->getComponent('episode-single')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function renderNewEpisodePage()
	{
		$this->page->title = "Créer un nouvel épisode";
		$this->page->bodyId = "episode-single";

		$this->page->view = $this->getComponent('episode-new')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function showAllPublish()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllPublish();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showAllDraft()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllDraft();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showAllTrash()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllTrash();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showOnePublish()
	{
		$episode_view = $this->getComponent('episode-single');
		$episode_view->episode = $this->getService('episodes')->getOnePublishByNumSlug(
			$this->HttpRequest->GETData('number'),
			$this->HttpRequest->GETData('slug')
		);

		$comments = $this->getService('comments')->getCommentsByEpisodeId($episode_view->episode->id());

		foreach ($comments as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$episode_view->comments .= $this->getComponent($component_name)->render();
		}

		$episode_view->new_comment_form = $this->getComponent('new-comment-form')->render();

		$this->renderSinglePage();
	}

	public function showNew()
	{
		$this->getComponent('episode-new')->episode = $this->getService('episodes')->setNewEpisode();

		$this->renderNewEpisodePage();
	}

	public function draftEpisode()
	{
		$this->getComponent('episode-new')->episode = $this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->POSTData('episode-number'),
			'part' => $this->HttpRequest->POSTData('episode-part'),
			'slug' => $this->HttpRequest->POSTData('episode-slug'),
			'title' => $this->HttpRequest->POSTData('mce_0'),
			'text' => $this->HttpRequest->POSTData('mce_1'),
			'status' => 'draft',
		]);

		try {
			$this->getService('episodes')->save($this->getComponent('episode-new')->episode);

			$this->getComponent('episode-new')->episode = $this->getService('episodes')->getOneDraftByNumSlug($this->getComponent('episode-new')->episode->number(), $this->getComponent('episode-new')->episode->slug());

			$this->HttpResponse->redirect(Router::genPath('episode', [$this->getComponent('episode-new')->episode->number(), $this->getComponent('episode-new')->episode->slug()]));
		} catch (\Exception $e) {
			$this->getComponent('episode-new')->warning = $e->getMessage();
			$this->renderNewEpisodePage();
		}
	}

	public function publishEpisode()
	{
		$this->getComponent('episode-new')->episode = $this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->POSTData('episode-number'),
			'part' => $this->HttpRequest->POSTData('episode-part'),
			'slug' => $this->HttpRequest->POSTData('episode-slug'),
			'title' => $this->HttpRequest->POSTData('mce_0'),
			'text' => $this->HttpRequest->POSTData('mce_1'),
		]);
		var_dump($_POST);
		$this->renderNewEpisodePage();
	}
}
