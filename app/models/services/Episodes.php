<?php
namespace Model\Service;

use \Model\Object\Episode;
use \Model\Mapper;

/**
* Episodes service
*/
class Episodes
{
	use \QFram\Helper\Formater;

	public function blank()
	{
		return new Episode;
	}

	public function add($data)
	{
		if (empty($data['mce_0']) || empty($data['mce_1']) || empty($data['mce_2'])) {
			return FALSE;
		}

		$data['part'] = !empty($data['part']) ? $data['part'] : NULL;
		$data['slug'] = $this->slugify($data['mce_1']);

		$episode = new Episode([
			'number' => $data['mce_0'],
			'part' => $data['part'],
			'title' => $data['mce_1'],
			'text' => $data['mce_2'],
			'slug' => $data['slug']
		]);

		$episodes = new Mapper\Episodes;
		$episodes->add($episode);
	}

	public function getById($id)
	{
		$episodes = new Mapper\Episodes;
		return $episodes->get($id);
	}
}
