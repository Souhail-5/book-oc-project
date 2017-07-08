<?php
/**
* Episodes Manager
*/
class EpisodesManager
{
	protected $db;

	function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(EpisodeModel $episode)
	{
		$q = $this->db->prepare('INSERT INTO episodes(number, title, text, publish_datetime, draft_datetime, nbr_comments, status) VALUES(:number, :title, :text, :publish_datetime, :draft_datetime, :nbr_comments, :status)');

		$q->bindValue(':number', $episode->number());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':publish_datetime', $episode->publish_datetime());
		$q->bindValue(':draft_datetime', $episode->draft_datetime());
		$q->bindValue(':nbr_comments', $episode->nbr_comments());
		$q->bindValue(':status', $episode->status());

		$q->execute();
	}

	public function update(EpisodeModel $episode)
	{
		$q = $this->db->prepare('UPDATE episodes SET number = :number, title = :title, text = :text, publish_datetime = :publish_datetime, draft_datetime = :draft_datetime, nbr_comments = :nbr_comments, status = :status WHERE id = :id');

		$q->bindValue(':number', $episode->number());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':publish_datetime', $episode->publish_datetime());
		$q->bindValue(':draft_datetime', $episode->draft_datetime());
		$q->bindValue(':nbr_comments', $episode->nbr_comments());
		$q->bindValue(':status', $episode->status());
		$q->bindValue(':id', $episode->id());

		$q->execute();
	}

	public function delete(EpisodeModel $episode)
	{
		$this->db->exec('DELETE FROM episodes WHERE id = '.$episode->id());
	}

	public function get($id)
	{
		$id = (int) $id;

		$q = $this->db->query('SELECT id, number, title, text, publish_datetime, draft_datetime, nbr_comments, status FROM episodes WHERE id = '.$id);
		$data = $q->fetch(PDO::FETCH_ASSOC);

		return new EpisodeModel($data);
	}

	public function getList()
	{
		$episodes = [];

		$q = $this->db->query('SELECT id, number, title, text, publish_datetime, draft_datetime, nbr_comments, status FROM episodes ORDER BY number DESC');

		while ($data = $q->fetch(PDO::FETCH_ASSOC)) {
			$episodes[] = new EpisodeModel($data);
		}

		return $episodes;
	}

	public function setDb(PDO $db)
	{
		$this->db = $db;
	}
}