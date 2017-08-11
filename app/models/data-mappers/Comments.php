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
		$this->db = PDOFactory::getConnexion('main');
	}

	public function add(Comment $comment)
	{
		$q = $this->db->prepare('
			INSERT INTO comments (episode_id, name, email, text)
			VALUES (:episode_id, :name, :email, :text)
		');

		$q->bindValue(':episode_id', $comment->episodeId());
		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());

		$q->execute();
	}

	public function update(Comment $comment)
	{
		$q = $this->db->prepare('
			UPDATE comments
			SET name=:name, email=:email, text=:text, nbr_signals=:nbr_signals, status=:status, approved=:approved, trash=:trash
			WHERE id=:id
		');

		$q->bindValue(':id', $comment->id());
		$q->bindValue(':name', $comment->name());
		$q->bindValue(':email', $comment->email());
		$q->bindValue(':text', $comment->text());
		$q->bindValue(':nbr_signals', $comment->nbrSignals());
		$q->bindValue(':status', $comment->status());
		$q->bindValue(':approved', (int) $comment->approved(), \PDO::PARAM_INT);
		$q->bindValue(':trash', (int) $comment->trash(), \PDO::PARAM_INT);

		$q->execute();
	}

	public function deleteComment(Comment $comment)
	{
		$q = $this->db->prepare('
			DELETE FROM comments
			WHERE id=:id
		');

		$q->bindValue(':id', $comment->id());

		$q->execute();
	}

	public function countPublish()
	{
		$q = $this->db->prepare('
			SELECT COUNT(id)
			FROM comments
			WHERE status=:status AND trash=:trash
		');

		$q->bindValue(':status', 'publish');
		$q->bindValue(':trash', 0);

		$q->execute();

		return $q->fetch()[0];
	}

	public function getPublish($page, $limit)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE status=:status AND trash=:trash
			ORDER BY publish_datetime ASC
			LIMIT :limit OFFSET :offset
		');

		$q->bindValue(':status', 'publish');
		$q->bindValue(':trash', 0);
		$q->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
		$q->bindValue(':offset', max((((int) $page * $limit) - $limit), 0), \PDO::PARAM_INT);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignals' => $data['nbr_signals'],
				'status' => $data['status'],
				'approved' => $data['approved'],
				'trash' => $data['trash'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function countApproved()
	{
		$q = $this->db->prepare('
			SELECT COUNT(id)
			FROM comments
			WHERE approved=:approved AND trash=:trash
		');

		$q->bindValue(':approved', 1);
		$q->bindValue(':trash', 0);

		$q->execute();

		return $q->fetch()[0];
	}

	public function getApproved($page, $limit)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE approved=:approved AND trash=:trash
			ORDER BY modification_datetime DESC
			LIMIT :limit OFFSET :offset
		');

		$q->bindValue(':approved', 1);
		$q->bindValue(':trash', 0);
		$q->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
		$q->bindValue(':offset', max((((int) $page * $limit) - $limit), 0), \PDO::PARAM_INT);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignals' => $data['nbr_signals'],
				'status' => $data['status'],
				'approved' => $data['approved'],
				'trash' => $data['trash'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function countSignaled()
	{
		$q = $this->db->prepare('
			SELECT COUNT(id)
			FROM comments
			WHERE nbr_signals>:nbr_signals AND approved=:approved AND trash=:trash
		');

		$q->bindValue(':nbr_signals', 0);
		$q->bindValue(':approved', 0);
		$q->bindValue(':trash', 0);

		$q->execute();

		return $q->fetch()[0];
	}

	public function getSignaled($page, $limit)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE nbr_signals>:nbr_signals AND approved=:approved AND trash=:trash
			ORDER BY publish_datetime ASC
			LIMIT :limit OFFSET :offset
		');

		$q->bindValue(':nbr_signals', 0);
		$q->bindValue(':approved', 0);
		$q->bindValue(':trash', 0);
		$q->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
		$q->bindValue(':offset', max((((int) $page * $limit) - $limit), 0), \PDO::PARAM_INT);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignals' => $data['nbr_signals'],
				'status' => $data['status'],
				'approved' => $data['approved'],
				'trash' => $data['trash'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function countTrash()
	{
		$q = $this->db->prepare('
			SELECT COUNT(id)
			FROM comments
			WHERE trash=:trash
		');

		$q->bindValue(':trash', 1);

		$q->execute();

		return $q->fetch()[0];
	}

	public function getTrash($page, $limit)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE trash=:trash
			ORDER BY publish_datetime ASC
			LIMIT :limit OFFSET :offset
		');

		$q->bindValue(':trash', 1);
		$q->bindValue(':limit', (int) $limit, \PDO::PARAM_INT);
		$q->bindValue(':offset', max((((int) $page * $limit) - $limit), 0), \PDO::PARAM_INT);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignals' => $data['nbr_signals'],
				'status' => $data['status'],
				'approved' => $data['approved'],
				'trash' => $data['trash'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function getCommentsByEpisodeId($episode_id)
	{
		$comments = [];

		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE episode_id=:episode_id AND status=:status AND trash=:trash
			ORDER BY publish_datetime ASC
		');

		$q->bindValue(':episode_id', $episode_id);
		$q->bindValue(':status', 'publish');
		$q->bindValue(':trash', 0);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'episodeId' => $data['episode_id'],
				'name' => $data['name'],
				'email' => $data['email'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'nbrSignals' => $data['nbr_signals'],
				'status' => $data['status'],
				'approved' => $data['approved'],
				'trash' => $data['trash'],
			];
			$comments[] = new Comment($map);
		}

		return $comments;
	}

	public function getCommentById($comment_id)
	{
		$q = $this->db->prepare('
			SELECT id, episode_id, name, email, text, publish_datetime, nbr_signals, status, approved, trash
			FROM comments
			WHERE id=:id
			LIMIT 1
		');

		$q->bindValue(':id', $comment_id);

		$q->execute();

		$data = $q->fetch(\PDO::FETCH_ASSOC);
		if (!$data) throw new \Exception("Aucun commentaire n'a été trouvé");

		$map = [
			'id' => $data['id'],
			'episodeId' => $data['episode_id'],
			'name' => $data['name'],
			'email' => $data['email'],
			'text' => $data['text'],
			'publishDatetime' => $data['publish_datetime'],
			'nbrSignals' => $data['nbr_signals'],
			'status' => $data['status'],
			'approved' => $data['approved'],
			'trash' => $data['trash'],
		];

		return new Comment($map);
	}
}
