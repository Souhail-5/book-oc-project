<?php
/**
* Episodes Manager
*/
class EpisodesManager
{
	protected $db;

	function __construct()
	{
		$this->getEpisodes();
	}

	public function add(Episode $episode)
	{

	}

	public function update(Episode $episode)
	{

	}

	public function delete(Episode $episode)
	{

	}

	public function get($id)
	{

	}

	public function getList()
	{

	}

	public function setDb(PDO $db)
	{
		$this->db = $db;
	}
}
