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
		if (empty($comment->name()) || empty($comment->email()) || empty($comment->text())) {
			throw new \Exception('Tous les champs sont obligatoires');
		}

		try {
			$this->comments->add($comment);
			$episodes_service = new Episodes;
			$episodes_service->plusNbrComments($comment->episodeId());
		} catch (\Exception $e) {
			return $e;
		}
	}

	public function update(Object\Comment $comment)
	{
		if (empty($comment->name()) || empty($comment->email()) || empty($comment->text())) {
			throw new \Exception('Tous les champs sont obligatoires');
		}

		try {
			$this->comments->update($comment);
		} catch (\Exception $e) {
			return $e;
		}
	}

	public function signalComment(Object\Comment $comment)
	{
		if ($this->comments->approved() == 0) {
			$this->comments->setNbrSignals($comment->nbrSignals()+1);
			$this->comments->update($comment);
		}
	}

	public function approveComment(Object\Comment $comment)
	{
		$this->comments->setApproved(1);
		$this->comments->update($comment);
	}

	public function disapproveComment(Object\Comment $comment)
	{
		$this->comments->setApproved(0);
		$this->comments->update($comment);
	}

	public function trashComment(Object\Comment $comment)
	{
		$this->comments->setTrash(1);
		$this->comments->update($comment);
		if ($this->comments->status() == 'publish') {
			$episodes_service = new Episodes;
			$episodes_service->minusNbrComments($comment->episodeId());
		}
	}

	public function untrashComment(Object\Comment $comment)
	{
		$this->comments->setTrash(0);
		$this->comments->update($comment);
		if ($this->comments->status() == 'publish') {
			$episodes_service = new Episodes;
			$episodes_service->plusNbrComments($comment->episodeId());
		}
	}

	public function deleteComment(Object\Comment $comment)
	{
		$this->comments->deleteComment($comment);
		if ($this->comments->status() == 'publish') {
			$episodes_service = new Episodes;
			$episodes_service->minusNbrComments($comment->episodeId());
		}
	}

	public function getPublish()
	{
		return $this->comments->getPublish();
	}

	public function getTrash()
	{
		return $this->comments->getTrash();
	}

	public function getSignaled()
	{
		return $this->comments->getSignaled();
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
