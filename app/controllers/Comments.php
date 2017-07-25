<?php
namespace Controller;

use \Controller\Controller;

/**
* Comments Controller
*/
class Comments extends Controller
{
	protected function init()
	{
		$this->initServices([
			'comments' => 'Comments',
		]);
		$this->initPage();
		$this->initComponents([
			'home' => 'home',
			'comments-list' => 'comments-list',
		]);
	}

	public function render()
	{
		$this->page->title = "Billet simple pour l'Alaska";
		$this->page->bodyId = "comments";
		$this->page->view = $this->getComponent('home')->render();

		$this->HttpResponse->send($this->page->render());
	}

	public function show()
	{
		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getValidComments();

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showCommentsSignaled()
	{
		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getSignaled();

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}


	public function signalComment()
	{
		$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
		$this->getService('comments')->plusNbrSignals($comment);
		$this->HttpResponse->redirect(Router::genPath('episode', [$this->HttpRequest->GETData('number'), $this->HttpRequest->GETData('slug')]));
	}

	public function trashComment()
	{
		$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
		$this->getService('comments')->trash($comment);
		$this->HttpResponse->refresh();
	}

	public function deleteComment()
	{
		$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
		$this->getService('comments')->delete($comment);
		$this->HttpResponse->redirect(Router::genPath('episode', [$this->HttpRequest->GETData('number'), $this->HttpRequest->GETData('slug')]));
	}
}
