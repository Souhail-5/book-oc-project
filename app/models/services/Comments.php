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

	public function plusNbrSignals(Object\Comment $comment)
	{
		$this->comments->plusNbrSignals($comment);
	}

	public function approve(Object\Comment $comment)
	{
		$this->comments->setStatus('approved');
		$this->comments->update($comment);
	}

	public function trash(Object\Comment $comment)
	{
		$this->comments->trash($comment);
		$episodes_service = new Episodes;
		$episodes_service->minusNbrComments($comment->episodeId());
	}

	public function delete(Object\Comment $comment)
	{
		$this->comments->delete($comment);
		$episodes_service = new Episodes;
		$episodes_service->minusNbrComments($comment->episodeId());
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

	public function getCommentById($comment_id)
	{
		return $this->comments->getCommentById($comment_id);
	}

	public function getCommentsByEpisodeId($episode_id)
	{
		return $this->comments->getCommentsByEpisodeId($episode_id);
	}
}
