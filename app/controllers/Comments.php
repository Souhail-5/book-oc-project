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
			'pagination' => 'pagination',
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
		$this->getComponent('pagination')->elements_limit_by_page = 1;
		$this->getComponent('pagination')->nbr_elements = $this->getService('comments')->countPublish();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->elements_limit_by_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getPublish($nbr_page, $this->getComponent('pagination')->elements_limit_by_page);

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$comments_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showSignaled()
	{
		$this->getComponent('pagination')->elements_limit_by_page = 1;
		$this->getComponent('pagination')->nbr_elements = $this->getService('comments')->countSignaled();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->elements_limit_by_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getSignaled($nbr_page, $this->getComponent('pagination')->elements_limit_by_page);

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$comments_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showApproved()
	{
		$this->getComponent('pagination')->elements_limit_by_page = 1;
		$this->getComponent('pagination')->nbr_elements = $this->getService('comments')->countApproved();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->elements_limit_by_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getApproved($nbr_page, $this->getComponent('pagination')->elements_limit_by_page);

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$comments_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function showTrash()
	{
		$this->getComponent('pagination')->elements_limit_by_page = 1;
		$this->getComponent('pagination')->nbr_elements = $this->getService('comments')->countTrash();
		$nbr_page = $this->HttpRequest->GETData('page');
		$nbr_pages = ceil($this->getComponent('pagination')->nbr_elements / $this->getComponent('pagination')->elements_limit_by_page);
		if (isset($nbr_page) && $nbr_page == 0) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name()));
		if ($nbr_page > $nbr_pages) $this->HttpResponse->redirect(Router::genPath(Router::currentRoute()->name(), [$nbr_pages]));

		$comments_view = $this->getComponent('comments-list');
		$comments_list = $this->getService('comments')->getTrash($nbr_page, $this->getComponent('pagination')->elements_limit_by_page);

		foreach ($comments_list as $comment) {
			$component_name = "comment-{$comment->id()}";
			$this->initComponents([$component_name => 'comment']);

			$this->getComponent($component_name)->comment = $comment;
			$comments_view->comments_list .= $this->getComponent($component_name)->render();
		}

		$comments_view->pagination = $this->getComponent('pagination')->render();

		$this->getComponent('home')->view = $comments_view->render();

		$this->render();
	}

	public function signalComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->signalComment($comment);
			$this->flash->hydrate([
				'type' => 'success',
				'title' => 'Merci',
				'text' => 'Votre signalement a bien été pris en compte. Ce commentaire sera modéré dès que possible.',
			]);
		} catch (\InvalidArgumentException $e) {
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Oups !',
				'text' => "Vous avez déjà signalé ce commentaire. Il sera modéré dès que possible.",
			]);
		} catch (\Exception $e) {
			$this->flash->hydrate([
				'type' => 'warning',
				'title' => 'Attention !',
				'text' => "Le signalement n'a pas pu être effectué.",
			]);
		}
		$this->HttpResponse->refresh();
	}

	public function approveComment()
	{
		try {
			$comment = $this->getService('comments')->getCommentById($this->HttpRequest->POSTData('comment-id'));
			$this->getService('comments')->approveComment($comment);
			$this->flash->hydrate([
				'type' => 'info',
				'title' => '',
				'text' => 'Le commentaire a bien été approuvé. <a href="'.Router::genPath('comments-approved').'">Voir les commentaires approuvés</a>.',
			]);
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
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Notification',
				'text' => 'Le commentaire a bien été désapprouvé.',
			]);
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
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Notification',
				'text' => 'Le commentaire a bien été mis à la corbeille. <a href="'.Router::genPath('comments-trash').'">Voir</a>.',
			]);
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
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Notification',
				'text' => 'Le commentaire a bien été restauré.',
			]);
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
			$this->flash->hydrate([
				'type' => 'info',
				'title' => 'Notification',
				'text' => 'Le commentaire a bien été supprimé.',
			]);
			$this->HttpResponse->refresh();
		} catch (\Exception $e) {
			$this->HttpResponse->redirect(Router::genPath('403'));
		}
	}
}
