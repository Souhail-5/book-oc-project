<?php
namespace Model\Service;

use \Model\Object;
use \Model\Mapper;

/**
* Episodes service
*/
class Episodes
{
	use \QFram\Helper\Formater;

	protected $episodes;

	public function __construct()
	{
		$this->episodes = new Mapper\Episodes;
	}

	public function setNewEpisode(array $data=[])
	{
		return new Object\Episode($data);
	}

	public function add(Object\Episode $episode)
	{
		if (empty($episode->title()) || empty($episode->title()) || empty($episode->title())) {
			throw new \Exception('Tous les champs sont obligatoires');
		}

		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setSlug($this->slugify($episode->title()));

		try {
			$this->episodes->add($episode);
		} catch (\Exception $e) {
			if ($e->getCode() == 23000) {
				$m0 = ($episode->part() == 0) ? '' : " (partie {$episode->part()})";
				$mf = "Un épisode numéroté {$episode->number()}{$m0} existe déjà.";
				throw new \Exception($mf);
			} else {
				return $e;
			}
		}
	}

	public function update(Object\Episode $episode)
	{
		if (empty($episode->title()) || empty($episode->title()) || empty($episode->title())) {
			throw new \Exception('Tous les champs sont obligatoires');
		}

		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setSlug($this->slugify($episode->title()));

		try {
			$this->episodes->update($episode);
		} catch (\Exception $e) {
			if ($e->getCode() == 23000) {
				$m0 = ($episode->part() == 0) ? '' : " (partie {$episode->part()})";
				$mf = "Un épisode numéroté {$episode->number()}{$m0} existe déjà.";
				throw new \Exception($mf);
			} else {
				return $e;
			}
		}
	}

	public function delete(Object\Episode $episode)
	{
		$this->episodes->delete($episode);
	}

	public function getEpisode(Object\Episode $episode)
	{
		return $this->episodes->get($episode);
	}
}