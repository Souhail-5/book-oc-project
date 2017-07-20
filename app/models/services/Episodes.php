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
		if (empty($episode->number()) || empty($episode->title()) || empty($episode->text())) {
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
		if (empty($episode->number()) || empty($episode->title()) || empty($episode->text())) {
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

	public function getEpisodes()
	{
		return $this->episodes->getEpisodes();
	}

	public function getEpisode(Object\Episode $episode)
	{
		return $this->episodes->get($episode);
	}

	public function plusNbrComments(Object\Episode $episode)
	{
		$this->episodes->plusNbrComments($episode);
	}

	public function minusNbrComments(Object\Episode $episode)
	{
		$this->episodes->plusNbrComments($episode);
	}
}
