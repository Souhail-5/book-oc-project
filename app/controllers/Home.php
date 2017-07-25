<?php
namespace Controller;

use \Controller\Controller;

/**
* Home Controller
*/
class Home extends Controller
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
			'comments-list' => 'comments-list',
		]);
	}

	public function render()
	{
		$this->page->title = "Billet simple pour l'Alaska";
		$this->page->bodyId = "home";
		$this->page->view = $this->getComponent('home')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function show()
	{
		$episodes_view = $this->getComponent('episodes-list');
		$episodes_view->episodes = $this->getService('episodes')->getEpisodes();

		$this->getComponent('home')->view = $episodes_view->render();

		$this->render();
	}

	public function showCommentsSignaled()
	{
		$comments_view = $this->getComponent('comments-list');
		$comments_signaled = $this->getService('comments')->getSignaled();

		foreach ($comments_signaled as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_signaled .= $this->getComponent($component_name)->render();
		}

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}
}
