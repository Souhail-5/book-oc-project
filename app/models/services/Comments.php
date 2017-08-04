<?php
namespace Model\Service;

use \Model\Object;
use \Model\Mapper;

/**
* Comments service
*/
class Comments
{
	protected $comments;

	public function __construct()
	{
		$this->comments = new Mapper\Comments;
	}

	public function setNewComment(array $data=[])
	{
		return new Object\Comment($data);
	}

	public function add(Object\Comment $comment)
	{
		$error = [];

		if (!preg_match('#^[a-zA-Z ]{5,50}$#', $comment->name()))
			$error[] = "Le nom ne doit comporter que des lettres et espaces. Sa longueur doit être comprise entre 5 et 50 caractères.";
		if (!filter_var($comment->email(), FILTER_VALIDATE_EMAIL))
			$error[] = "L'email doit être sous la forme de mon@exemple.com";
		if (!preg_match('#^(.){140,1400}$#', $comment->text()))
			$error[] = "La longueur du commentaire doit être comprise entre 140 et 1400 caractères.";

		if (!empty($error)) throw new \Exception(implode('<br>', $error));

		$comment->setStatus('publish');

		try {
			$this->comments->add($comment);
			if ($comment->status() == 'publish') {
				$episodes_service = new Episodes;
				$episodes_service->plusNbrComments($comment->episodeId());
			}
		} catch (\Exception $e) {
			return $e;
		}
	}

	public function signalComment(Object\Comment $comment)
	{
		if ($comment->approved() == 0) {
			$comment->setNbrSignals($comment->nbrSignals()+1);
			try {
				$this->comments->update($comment);
			} catch (\Exception $e) {
				return $e;
			}
		}
	}

	public function approveComment(Object\Comment $comment)
	{
		$comment->setApproved(1);
		$this->comments->update($comment);
	}

	public function disapproveComment(Object\Comment $comment)
	{
		$comment->setApproved(0);
		$this->comments->update($comment);
	}

	public function trashComment(Object\Comment $comment)
	{
		$comment->setTrash(1);
		$this->comments->update($comment);
		if ($comment->status() == 'publish') {
			$episodes_service = new Episodes;
			$episodes_service->minusNbrComments($comment->episodeId());
		}
	}

	public function untrashComment(Object\Comment $comment)
	{
		$comment->setTrash(0);
		$this->comments->update($comment);
		if ($comment->status() == 'publish') {
			$episodes_service = new Episodes;
			$episodes_service->plusNbrComments($comment->episodeId());
		}
	}

	public function deleteComment(Object\Comment $comment)
	{
		$this->comments->deleteComment($comment);
	}

	public function getPublish()
	{
		return $this->comments->getPublish();
	}

	public function getApproved()
	{
		return $this->comments->getApproved();
	}

	public function getSignaled()
	{
		return $this->comments->getSignaled();
	}

	public function getTrash()
	{
		return $this->comments->getTrash();
	}

	public function getCommentsByEpisodeId($episode_id)
	{
		return $this->comments->getCommentsByEpisodeId($episode_id);
	}

	public function getCommentById($comment_id)
	{
		try {
			return $this->comments->getCommentById($comment_id);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
