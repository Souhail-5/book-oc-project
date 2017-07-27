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

	public function add(Episode $episode)
	{
		$q = $this->db->prepare('
			INSERT INTO episodes (number, part, title, text, slug)
			VALUES (:number, :part, :title, :text, :slug)
		');

		$q->bindValue(':number', $episode->number());
		$q->bindValue(':part', $episode->part());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':slug', $episode->slug());
		$q->bindValue(':status', $episode->status());

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
		$q->bindValue(':trash', $episode->trash());

		$q->execute();
	}

	public function delete(Episode $episode)
	{
		$q = $this->db->prepare('
			DELETE FROM episodes
			WHERE id=:id
		');

		$q->bindValue(':id', $episode->id());

		$q->execute();
	}

	public function get(Episode $episode)
	{
		$where = !empty($episode->id()) ? 'id=:id' : 'number=:number AND slug=:slug';
		$q = $this->db->prepare("
			SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, status, slug
			FROM episodes
			WHERE {$where}
			LIMIT 1
		");

		if (!empty($episode->id())) {
			$q->bindValue(':id', $episode->id());
		} else {
			$q->bindValue(':number', $episode->number());
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
			'status' => $data['status'],
			'slug' => $data['slug'],
		];

		return new Episode($map);
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

	public function plusNbrComments($episode_id)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET nbr_comments = nbr_comments+1
			WHERE id=:id
		');

		$q->bindValue(':id', $episode_id);

		$q->execute();
	}

	public function minusNbrComments($episode_id)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET nbr_comments = nbr_comments-1
			WHERE id=:id
		');

		$q->bindValue(':id', $episode_id);

		$q->execute();
	}
}
