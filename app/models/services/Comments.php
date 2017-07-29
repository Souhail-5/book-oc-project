<?php
namespace Model\Service;

use \Model\Object;
use \Model\Mapper;

/**
* Comments service
*/
class Comments
{
	use \QFram\Helper\Formater;

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

		if (empty($comment->name())) $error[] = "Vous devez renseigner un nom valide : au moins une lettre.";
		if (empty($comment->email())) $error[] = "Vous devez renseigner un e-mail valide : voici.un@example.com .";
		if (empty($comment->text())) $error[] = "Vous devez renseigner un commentaire valide : au moins un caractère.";

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
			$this->comments->update($comment);
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
		return $this->comments->getCommentById($comment_id);
	}
}
