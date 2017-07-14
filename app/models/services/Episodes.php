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

	public function getNewEpisode(array $data=[])
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

	public function update($data)
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
			$this->episodes->update($episode);
			return $episode;
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

	public function delete($id)
	{
		$this->episodes->delete($id);
	}

	public function getEpisode($number, $slug)
	{
		return $this->episodes->get($number, $slug);
	}
}
