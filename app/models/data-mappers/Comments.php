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
			INSERT INTO comments (episode_id, name, email, text)
			VALUES (:episode_id, :name, :email, :text)
		');

		$q->bindValue(':episode_id', $comment->episode_id());
		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());

		$q->execute();
	}

	public function update(Comment $comment)
	{
		$q = $this->db->prepare('
			UPDATE comments
			SET name=:name, email=:email, text=:text, nbr_signal=:nbr_signal
			WHERE id=:id
		');

		$q->bindValue(':id', $comment->id());
		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());
		$q->bindValue(':nbr_signal', $comment->nbrSignal());

		$q->execute();
	}

	public function delete(Comment $comment)
	{
		$this->db->exec("DELETE FROM comments WHERE id={$comment->id()}");
	}

	public function getList($episode_id)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signal
			FROM comments
			WHERE episode_id=:episode_id
			ORDER BY publish_datetime DESC
		');

		$q->bindValue(':episode_id', $episode_id);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignal' => $data['nbr_signal'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function getSignaled()
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signal
			FROM comments
			WHERE nbr_signal>0
			ORDER BY publish_datetime DESC
		');

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignal' => $data['nbr_signal'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}
}
