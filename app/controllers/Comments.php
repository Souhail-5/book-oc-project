<?php
namespace Controller;

use \QFram\Router;
use \QFram\Controller;

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
		$comments_list = $this->getService('comments')->getPublish();

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showSignaled()
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

	public function showApproved()
	{
		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getApproved();

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showTrash()
	{
		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getTrash();

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
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->signalComment($comment);
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Notification',
				'text' => 'Le signalement a bien été pris en compte',
			]);
		} catch (\Exception $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Attention !',
				'text' => "Le signalement n'a pas pu être effectué",
			]);
		}
		$this->HttpResponse->refresh();
	}

	public function approveComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->approveComment($comment);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function disapproveComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->disapproveComment($comment);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function trashComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->trashComment($comment);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function untrashComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->untrashComment($comment);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}

	public function deleteComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->deleteComment($comment);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}
}
