<?php
namespace Controller;

use \QFram\Router;
use \QFram\Controller;

/**
* Episodes Controller
*/
class Episodes extends Controller
{
	const NBR_ELEMENTS_PER_PAGE = 10;

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
			'pagination' => 'pagination',
			'episode-single' => 'episode-single',
			'new-comment-form' => 'new-comment-form',
			'episode-new' => 'episode-new',
		]);
		if ($this->user->isAuthenticated()) {
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
		$this->getComponent('pagination')->nbr_elements_per_page = self::NBR_ELEMENTS_PER_PAGE;
		$this->getComponent('pagination')->nbr_elements = $this->getService('episodes')->countAllPublish();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->nbr_elements_per_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllPublish($nbr_page, $this->getComponent('pagination')->nbr_elements_per_page);
		$episodes_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showAllDraft()
	{
		$this->getComponent('pagination')->nbr_elements_per_page = self::NBR_ELEMENTS_PER_PAGE;
		$this->getComponent('pagination')->nbr_elements = $this->getService('episodes')->countAllDraft();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->nbr_elements_per_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllDraft($nbr_page, $this->getComponent('pagination')->nbr_elements_per_page);
		$episodes_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showAllTrash()
	{
		$this->getComponent('pagination')->nbr_elements_per_page = self::NBR_ELEMENTS_PER_PAGE;
		$this->getComponent('pagination')->nbr_elements = $this->getService('episodes')->countAllTrash();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->nbr_elements_per_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getAllTrash($nbr_page, $this->getComponent('pagination')->nbr_elements_per_page);
		$episodes_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->renderHomePage();
	}

	public function showOne()
	{
		$episode_view = $this->getComponent('episode-single');
		try {
			$episode_view->episode = $this->getService('episodes')->getOne(
				$this->getService('episodes')->setNewEpisode([
					'slug' => $this->HttpRequest->GETData('slug'),
				])
			);
			if ($episode_view->episode->trash()) throw new \Exception("Cette épisode n'est pas accessible");
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('404'));
		}

		if ($episode_view->episode->status() == 'draft') return $this->renderSinglePage();

		$comments = $this->getService('comments')->getCommentsByEpisodeId($episode_view->episode->id());

		foreach ($comments as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$episode_view->comments .= $this->getComponent($component_name)->render();
		}

		$new_comment_form = $this->getComponent('new-comment-form');
		$new_comment = $new_comment_form->comment;
		if (!isset($new_comment)) $new_comment_form->comment = $this->getService('comments')->setNewComment();
		$new_comment_form->episode = $episode_view->episode;
		$episode_view->new_comment_form = $new_comment_form->render();

		$this->renderSinglePage();
	}

	public function showNew()
	{
		$this->getComponent('episode-new')->episode = $this->getService('episodes')->setNewEpisode();

		$this->renderNewEpisodePage();
	}

	public function draftEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		$episode = $this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->POSTData('episode-number'),
			'part' => $this->HttpRequest->POSTData('episode-part'),
			'slug' => $this->HttpRequest->POSTData('episode-slug'),
			'title' => $this->HttpRequest->POSTData('mce_0'),
			'text' => $this->HttpRequest->POSTData('mce_1'),
			'status' => 'draft',
		]);

		try {
			$episode_id = $this->getService('episodes')->save($episode);

			$episode = $this->getService('episodes')->getOne($this->getService('episodes')->setNewEpisode([
				'id' => $episode_id,
			]));

			$this->flash->hydrate([
				'type' => 'success',
				'title' => 'Brouillon enregistré',
				'text' => 'Un nouveau brouillon a bien été enregistré.',
			]);

			$this->HttpResponse->redirect(Router::genPath('episode', [$episode->slug()]));
		} catch (\InvalidArgumentException $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Attention !',
				'text' => $e->getMessage(),
			]);
			$this->getComponent('episode-new')->episode = $episode;
			$this->renderNewEpisodePage();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function publishNewEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		$episode = $this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->POSTData('episode-number'),
			'part' => $this->HttpRequest->POSTData('episode-part'),
			'slug' => $this->HttpRequest->POSTData('episode-slug'),
			'title' => $this->HttpRequest->POSTData('mce_0'),
			'text' => $this->HttpRequest->POSTData('mce_1'),
			'status' => 'publish',
		]);

		try {
			$episode_id = $this->getService('episodes')->save($episode, true);

			$episode = $this->getService('episodes')->getOne($this->getService('episodes')->setNewEpisode([
				'id' => $episode_id,
			]));

			$this->flash->hydrate([
				'type' => 'success',
				'title' => 'Bravo !',
				'text' => 'Votre nouvel épisode a été directement publié.',
			]);

			$this->HttpResponse->redirect(Router::genPath('episode', [$episode->slug()]));
		} catch (\InvalidArgumentException $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Attention !',
				'text' => $e->getMessage(),
			]);
			$this->getComponent('episode-new')->episode = $episode;
			$this->renderNewEpisodePage();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function publishEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));
		$this->flash->hydrate([
			'type' => 'success',
			'title' => 'Bravo !',
			'text' => 'Cet épisode est maintenant publié et visible par tous.',
		]);
		$this->updateEpisode(true);
	}

	public function updateEpisode($publish=false)
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		try {
			$episode = $this->getService('episodes')->getOne(
				$this->getService('episodes')->setNewEpisode([
					'id' => $this->HttpRequest->POSTData('episode-id'),
				])
			);
			$episode->setNumber($this->HttpRequest->POSTData('episode-number'));
			$episode->setPart($this->HttpRequest->POSTData('episode-part'));
			$episode->setSlug($this->HttpRequest->POSTData('episode-slug'));
			$episode->setTitle($this->HttpRequest->POSTData('mce_0'));
			$episode->setText($this->HttpRequest->POSTData('mce_1'));

			$this->getService('episodes')->update($episode, $publish);

			$episode = $this->getService('episodes')->getOne($episode);

			if (!$publish) $this->flash->hydrate([
				'type' => 'info',
				'title' => 'Modification enregistré',
				'text' => 'Vos modifications ont bien été prises en compte.',
			]);

			$this->HttpResponse->redirect(Router::genPath('episode', [$episode->slug()]));
		} catch (\InvalidArgumentException $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => "Aucune modification n'a été prise en compte",
				'text' => $e->getMessage(),
			]);
			$this->getComponent('episode-single')->episode = $episode;

			$this->renderSinglePage();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function trashEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		try {
			$episode = $this->getService('episodes')->getOne(
				$this->getService('episodes')->setNewEpisode([
					'id' => $this->HttpRequest->POSTData('episode-id'),
				])
			);
			$this->getService('episodes')->trashOne($episode);
			$this->flash->hydrate([
				'type' => 'info',
				'title' => '',
				'text' => 'L\'épisode a bien été mis à la corbeille. <a href="'.Router::genPath('episodes-trash').'">Voir la corbeille</a>.',
			]);
			$this->HttpResponse->redirect(Router::genPath('episodes'));
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function untrashEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		try {
			$episode = $this->getService('episodes')->getOne(
				$this->getService('episodes')->setNewEpisode([
					'id' => $this->HttpRequest->POSTData('episode-id'),
				])
			);
			$this->getService('episodes')->untrashOne($episode);
			$this->flash->hydrate([
				'type' => 'info',
				'title' => '',
				'text' => 'L\'épisode a bien été restauré.',
			]);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function deleteEpisode()
	{
		if (!$this->user->isAuthenticated()) $this->HttpResponse->redirect(Router::genPath('403'));

		try {
			$episode = $this->getService('episodes')->getOne(
				$this->getService('episodes')->setNewEpisode([
					'id' => $this->HttpRequest->POSTData('episode-id'),
				])
			);
			$this->getService('episodes')->deleteOne($episode);
			$this->flash->hydrate([
				'type' => 'info',
				'title' => '',
				'text' => 'L\'épisode a été définitivement supprimé.',
			]);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function newEpisodeComment()
	{
		$this->getComponent('new-comment-form')->comment = $this->getService('comments')->setNewComment([
			'episodeId' => $this->HttpRequest->POSTData('episode-id'),
			'name' => $this->HttpRequest->POSTData('comment-name'),
			'email' => $this->HttpRequest->POSTData('comment-email'),
			'text' => $this->HttpRequest->POSTData('comment-text'),
		]);
		try {
			$this->getService('comments')->add($this->getComponent('new-comment-form')->comment);
			$this->getComponent('new-comment-form')->comment = null;
			$this->showOne();
		} catch (\InvalidArgumentException $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Attention !',
				'text' => $e->getMessage(),
			]);
			$this->showOne();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function signalComment()
	{
		$comment_controller = new Comments($this->HttpRequest, $this->HttpResponse, 'signalComment');
		$comment_controller->run();
	}
}
