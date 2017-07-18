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

	public function delete(Object\Comment $comment)
	{
		$this->comments->delete($comment);
	}

	public function getList($episode_id)
	{
		return $this->comments->getList();
	}

	public function getSignaled($episode_id)
	{
		return $this->comments->getSignaled();
	}
}
