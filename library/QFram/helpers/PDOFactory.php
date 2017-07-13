<?php
namespace QFram\Helper;

class PDOFactory
{
	public static function getMysqlConnexion()
	{
		$db = new \PDO('mysql:host=localhost;dbname=project3', 'root', 'root');
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
