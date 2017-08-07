<?php
namespace Model\Mapper;

use \Model\Object\Signal;
use \QFram\Helper\PDOFactory;

/**
* Signals Manager
*/
class Signals
{
	protected $db;

	function __construct()
	{
		$this->db = PDOFactory::getMysqlConnexion();
	}

	public function add(Signal $signal)
	{
		$q = $this->db->prepare('
			INSERT INTO signals (comment_id, ip_address)
			VALUES (:comment_id, :ip_address)
		');

		$q->bindValue(':comment_id', $signal->commentId());
		$q->bindValue(':ip_address', $_SERVER['REMOTE_ADDR']);

		$q->execute();
	}

	public function hasAlreadySignaledComment(Signal $signal)
	{
		$q = $this->db->prepare('
			SELECT id
			FROM signals
			WHERE comment_id=:comment_id AND ip_address=:ip_address
		');

		$q->bindValue(':comment_id', $signal->commentId());
		$q->bindValue(':ip_address', $_SERVER['REMOTE_ADDR']);

		$q->execute();

		if ($q->rowCount()) return true;
		return false;
	}
}
