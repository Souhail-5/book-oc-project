<?php
namespace Model\Mapper;

use \Model\Object\Episode;
use \QFram\Helper\PDOFactory;

/**
* Episodes Manager
*/
class Episodes
{
	protected $db;

	function __construct()
	{
		$this->db = PDOFactory::getMysqlConnexion();
	}

	public function add(Episode $episode, $publish=false)
	{
		$publish_datetime = 'null';
		if ($publish) $publish_datetime = 'NOW()';

		$q = $this->db->prepare("
			INSERT INTO episodes (number, part, title, text, publish_datetime, slug, status)
			VALUES (:number, :part, :title, :text, {$publish_datetime}, :slug, :status)
		");

		$q->bindValue(':number', $episode->number());
		$q->bindValue(':part', $episode->part());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':slug', $episode->slug());
		$q->bindValue(':status', $episode->status());

		$q->execute();
	}

	public function publish(Episode $episode)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET publish_datetime=NOW(), status=:status
			WHERE id=:id
		');

		$q->bindValue(':id', $episode->id());
		$q->bindValue(':status', 'publish');

		$q->execute();
	}

	public function update(Episode $episode)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET number = :number, part=:part, title=:title, text=:text, nbr_comments=:nbr_comments, slug=:slug, status=:status, trash=:trash
			WHERE id=:id
		');

		$q->bindValue(':id', $episode->id());
		$q->bindValue(':number', $episode->number());
		$q->bindValue(':part', $episode->part());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':nbr_comments', $episode->nbrComments());
		$q->bindValue(':slug', $episode->slug());
		$q->bindValue(':status', $episode->status());
		$q->bindValue(':trash', (int) $episode->trash(), \PDO::PARAM_INT);

		$q->execute();
	}

	public function deleteOne(Episode $episode)
	{
		$q = $this->db->prepare('
			DELETE FROM episodes
			WHERE id=:id
		');

		$q->bindValue(':id', $episode->id());

		$q->execute();
	}

	public function getAllPublish()
	{
		$episodes = [];

		$q = $this->db->prepare('
			SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, slug, status, trash
			FROM episodes
			WHERE status=:status AND trash=:trash
			ORDER BY number DESC
		');

		$q->bindValue(':status', 'publish');
		$q->bindValue(':trash', 0);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'number' => $data['number'],
				'part' => $data['part'],
				'title' => $data['title'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'modificationDatetime' => $data['modification_datetime'],
				'nbrComments' => $data['nbr_comments'],
				'slug' => $data['slug'],
				'status' => $data['status'],
				'trash' => $data['trash'],
			];
			$episodes[] = new Episode($map);
		}

		return $episodes;
	}

	public function getAllDraft()
	{
		$episodes = [];

		$q = $this->db->prepare('
			SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, slug, status, trash
			FROM episodes
			WHERE status=:status AND trash=:trash
			ORDER BY number DESC
		');

		$q->bindValue(':status', 'draft');
		$q->bindValue(':trash', 0);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'number' => $data['number'],
				'part' => $data['part'],
				'title' => $data['title'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'modificationDatetime' => $data['modification_datetime'],
				'nbrComments' => $data['nbr_comments'],
				'slug' => $data['slug'],
				'status' => $data['status'],
				'trash' => $data['trash'],
			];
			$episodes[] = new Episode($map);
		}

		return $episodes;
	}

	public function getAllTrash()
	{
		$episodes = [];

		$q = $this->db->prepare('
			SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, slug, status, trash
			FROM episodes
			WHERE trash=:trash
			ORDER BY number DESC
		');

		$q->bindValue(':trash', 1);

		$q->execute();

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$map = [
				'id' => $data['id'],
				'number' => $data['number'],
				'part' => $data['part'],
				'title' => $data['title'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'modificationDatetime' => $data['modification_datetime'],
				'nbrComments' => $data['nbr_comments'],
				'slug' => $data['slug'],
				'status' => $data['status'],
				'trash' => $data['trash'],
			];
			$episodes[] = new Episode($map);
		}

		return $episodes;
	}

	public function getOne(Episode $episode)
	{
		$where = 'slug=:slug';

		if (!empty($episode->id())) $where = 'id=:id';

		$q = $this->db->prepare("
			SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, slug, status, trash
			FROM episodes
			WHERE {$where}
			LIMIT 1
		");

		if (!empty($episode->id())) {
			$q->bindValue(':id', $episode->id());
		} else {
			$q->bindValue(':slug', $episode->slug());
		}

		$q->execute();

		$data = $q->fetch(\PDO::FETCH_ASSOC);
		$map = [
			'id' => $data['id'],
			'number' => $data['number'],
			'part' => $data['part'],
			'title' => $data['title'],
			'text' => $data['text'],
			'publishDatetime' => $data['publish_datetime'],
			'modificationDatetime' => $data['modification_datetime'],
			'nbrComments' => $data['nbr_comments'],
			'slug' => $data['slug'],
			'status' => $data['status'],
			'trash' => $data['trash'],
		];

		return new Episode($map);
	}

	public function plusNbrComments($episode_id)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET nbr_comments = (nbr_comments+1)
			WHERE id=:id
		');

		$q->bindValue(':id', $episode_id);

		$q->execute();
	}

	public function minusNbrComments($episode_id)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET nbr_comments = (nbr_comments-1)
			WHERE id=:id
		');

		$q->bindValue(':id', $episode_id);

		$q->execute();
	}
}
