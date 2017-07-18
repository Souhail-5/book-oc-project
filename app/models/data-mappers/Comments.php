<?php
namespace Model\Mapper;

use \Model\Object\Comment;
use \QFram\Helper\PDOFactory;

/**
* Comments Mapper
*/
class Comments
{
	protected $db;

	function __construct()
	{
		$this->db = PDOFactory::getMysqlConnexion();
	}

	public function add(Comment $comment)
	{
		$q = $this->db->prepare('
			INSERT INTO comments (name, email, text)
			VALUES (:name, :email, :text)
		');

		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());

		$q->execute();
	}

	public function update(Comment $comment)
	{
		$q = $this->db->prepare('
			UPDATE comments
			SET name=:name, email=:email, text=:text, signal=:signal
			WHERE id=:id
		');

		$q->bindValue(':id', $comment->id());
		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());
		$q->bindValue(':signal', $comment->signal());

		$q->execute();
	}

	public function delete(Comment $comment)
	{
		$this->db->exec("DELETE FROM comments WHERE id={$comment->id()}");
	}

	public function getList()
	{
		$comments = [];

		$q = $this->db->query('SELECT id, name, email, text, publish_datetime, signal FROM comments ORDER BY publish_datetime DESC');

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publishDatetime'],
				'signal' => $data['signal'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function getSignaled()
	{
		$comments = [];

		$q = $this->db->query('SELECT id, name, email, text, publish_datetime, signal FROM comments WHERE signal>0 ORDER BY publish_datetime DESC');

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publishDatetime'],
				'signal' => $data['signal'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}
}
