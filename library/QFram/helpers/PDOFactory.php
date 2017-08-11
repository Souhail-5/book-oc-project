<?php
namespace QFram\Helper;

class PDOFactory
{
	protected static $databases;

	public function __construct()
	{
		if (empty(self::$databases)) {
			self::$databases = json_decode(file_get_contents(__DIR__.'/../../../app/config/databases.json'), true);
		}
	}

	public static function getConnexion($database)
	{
		$db_config = self::$databases[$database];
		$db = new \PDO(
			"{$db_config['type']}:host={$db_config['host']};dbname={$db_config['name']}",
			$db_config['user'],
			$db_config['password']
		);
		$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

		return $db;
	}
}
