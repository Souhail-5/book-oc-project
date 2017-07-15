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

		$q->execute();
	}

	public function update(Episode $episode)
	{
		$q = $this->db->prepare('
			UPDATE episodes
			SET number = :number, part=:part, title=:title, text=:text, status=:status, slug=:slug
			WHERE id=:id
		');

		$q->bindValue(':id', $episode->id());
		$q->bindValue(':number', $episode->number());
		$q->bindValue(':part', $episode->part());
		$q->bindValue(':title', $episode->title());
		$q->bindValue(':text', $episode->text());
		$q->bindValue(':status', $episode->status());
		$q->bindValue(':slug', $episode->slug());

		$q->execute();
	}

	public function delete(Episode $episode)
	{
		$this->db->exec('DELETE FROM episodes WHERE id = '.$episode->id());
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

		return new Episode((array) $data);
	}

	public function getList()
	{
		$episodes = [];

		$q = $this->db->query('SELECT id, number, part, title, text, publish_datetime, modification_datetime, nbr_comments, status, slug FROM episodes ORDER BY number DESC');

		while ($data = $q->fetch(\PDO::FETCH_ASSOC)) {
			$d = [
				'id' => $data['id'],
				'number' => $data['number'],
				'part' => $data['part'],
				'title' => $data['title'],
				'text' => $data['text'],
				'publishDatetime' => $data['publish_datetime'],
				'draftDatetime' => $data['modification_datetime'],
				'nbrComments' => $data['nbr_comments'],
				'status' => $data['status'],
				'slug' => $data['slug'],
			];
			$episodes[] = new Episode($d);
		}

		return $episodes;
	}

	public function setDb(\PDO $db)
	{
		$this->db = $db;
	}
}
