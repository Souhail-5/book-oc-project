<?php
namespace Controller;

use \Controller\Controller;
use \QFram\Router;

/**
* Episode Controller
*/
class Episode extends Controller
{
	protected function init()
	{
		$this->initServices([
			'episodes' => 'Episodes',
			'comments' => 'Comments',
		]);
		$this->initPage();
		$this->initComponents([
			'episode' => 'episode',
			'new-comment-form' => 'new-comment-form',
		]);
	}

	public function show()
	{
		$episode_template = $this->getComponent('episode');
		$episode_template->user = true;
		$episode_template->episode = $this->getService('episodes')->getEpisode($this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->GETData('number'),
			'slug' => $this->HttpRequest->GETData('slug')
		]));

		$comments = $this->getService('comments')->getComments($episode_template->episode->id());

		foreach ($comments as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$episode_template->comments .= $this->getComponent($component_name)->render();
		}

		$episode_template->new_comment_form = $this->getComponent('new-comment-form')->render();

		$this->page->title = "Nom de l'épisode";
		$this->page->bodyId = "episode";
		$this->page->addScripts([
			'<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=kivzmmaltnur462zqk88udo27pcq653plylb48017r3cq75i"></script>'
		]);
		$this->page->addCustomBtmScripts(["tinymce.init({
			selector: '.editable-content',
			inline: true,
			theme: 'inlite',
			selection_toolbar: 'bold italic | blockquote h2 h3',
			insert_toolbar: '',
			branding: false
		});"]);

		$this->page->view = $episode_template->render();

		echo $this->page->render();
	}

	public function updateEpisode()
	{
		$episode_template = $this->getComponent('episode');
		$episode_template->new_comment_form = false;
		$episode_template->user = true;
		$episode_template->episode = $this->getService('episodes')->getEpisode(
			$this->getService('episodes')->setNewEpisode(
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
			$this->getService('episodes')->update($episode_template->episode);

			// Puisque le slug peut changer en cas de changement du titre. Récupère le nouveau slug et redirige
			$episode_template->episode = $this->getService('episodes')->getEpisode($episode_template->episode);
			$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function deleteEpisode()
	{
		$episode = $this->getService('episodes')->getEpisode(
			$this->getService('episodes')->setNewEpisode(
				[
					'number' => $this->HttpRequest->GETData('number'),
					'slug' => $this->HttpRequest->GETData('slug')
				]
			)
		);
		try {
			$this->getService('episodes')->delete($episode);
			$this->HttpResponse->redirect(Router::getPath('root'));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function newEpisodeComment()
	{
		$episode_template = $this->getComponent('episode');
		$new_comment_form = $this->getComponent('new-comment-form');
		$episode_template->new_comment_form = $new_comment_form->render();
		$episode_template->user = true;
		$episode_template->episode = $this->getService('episodes')->getEpisode($this->getService('episodes')->setNewEpisode([
			'number' => $this->HttpRequest->GETData('number'),
			'slug' => $this->HttpRequest->GETData('slug')
		]));
		try {
			$new_comment = $this->getService('comments')->setNewComment([
				'episodeId' => $episode_template->episode->id(),
				'name' => $this->HttpRequest->POSTData('comment-name'),
				'email' => $this->HttpRequest->POSTData('comment-email'),
				'text' => $this->HttpRequest->POSTData('comment-text'),
			]);
			$this->getService('comments')->add($new_comment);
			$this->HttpResponse->redirect(Router::getPath('episode', [$episode_template->episode->number(), $episode_template->episode->slug()]));
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function signalComment()
	{
		$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
		$this->getService('comments')->plusNbrSignals($comment);
		$this->HttpResponse->redirect(Router::getPath('episode', [$this->HttpRequest->GETData('number'), $this->HttpRequest->GETData('slug')]));
	}

	public function deleteComment()
	{
		$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
		$this->getService('comments')->delete($comment);
		$this->HttpResponse->redirect(Router::getPath('episode', [$this->HttpRequest->GETData('number'), $this->HttpRequest->GETData('slug')]));
	}
}
