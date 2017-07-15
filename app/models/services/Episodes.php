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

	public function add($data)
	{
		if (empty($data['mce_0']) || empty($data['mce_2']) || empty($data['mce_3'])) {
			throw new \Exception('Tous les champs sont obligatoires');
		}

		$data['mce_1'] = !empty($data['mce_1']) ? $data['mce_1'] : 0;
		$data['slug'] = $this->slugify($data['mce_2']);

		$episode = new Object\Episode([
			'number' => $data['mce_0'],
			'part' => $data['mce_1'],
			'title' => $data['mce_2'],
			'text' => $data['mce_3'],
			'slug' => $data['slug']
		]);

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
