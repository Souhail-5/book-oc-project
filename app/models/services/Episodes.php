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

	public function save(Object\Episode $episode, $publish=false)
	{
		$error = [];

		if (empty($episode->number()) && $episode->number() != 0) $error[] = "Vous devez renseigner un numéro d'épisode valide : au moins un chiffre.";
		if (empty($episode->title())) $error[] = "Vous devez renseigner un titre d'épisode valide : au moins une lettre ou un chiffre.";
		if (empty($episode->text())) $error[] = "Vous devez renseigner un contenu d'épisode valide : au moins un caractère.";

		if (!empty($error)) throw new \Exception(implode('<br>', $error));

		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setSlug(!empty($episode->slug()) ? $episode->slug() : $this->slugify($episode->title()));

		try {
			$this->episodes->add($episode, $publish);
		} catch (\Exception $e) {
			if ($e->getCode() == 23000) {
				$m = ($episode->part() == 0) ? '' : "(partie {$episode->part()})";
				$error[] = "Un épisode numéroté {$episode->number()} {$m} existe déjà.";
				throw new \Exception(implode(' ', $error));
			} else {
				return $e;
			}
		}
	}

	public function update(Object\Episode $episode)
	{
		$error = [];
		var_dump($episode);
		if (empty($episode->number()) && $episode->number() != 0) $error[] = "Vous devez renseigner un numéro d'épisode valide : au moins un chiffre.";
		if (empty($episode->title())) $error[] = "Vous devez renseigner un titre d'épisode valide : au moins une lettre ou un chiffre.";
		if (empty($episode->text())) $error[] = "Vous devez renseigner un contenu d'épisode valide : au moins un caractère.";

		if (!empty($error)) throw new \Exception(implode('<br>', $error));

		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setSlug(!empty($episode->slug()) ? $episode->slug() : $this->slugify($episode->title()));
		$episode->setTrash(0);

		try {
			$this->episodes->update($episode);
		} catch (\Exception $e) {
			if ($e->getCode() == 23000) {
				$m = ($episode->part() == 0) ? '' : "(partie {$episode->part()})";
				$error[] = "Un épisode numéroté {$episode->number()} {$m} existe déjà.";
				throw new \Exception(implode(' ', $error));
			} else {
				return $e;
			}
		}
	}

	public function delete(Object\Episode $episode)
	{
		$this->episodes->delete($episode);
	}

	public function getAllPublish()
	{
		return $this->episodes->getAllPublish();
	}

	public function getAllDraft()
	{
		return $this->episodes->getAllDraft();
	}

	public function getAllTrash()
	{
		return $this->episodes->getAllTrash();
	}

	public function getOne(Object\Episode $episode)
	{
		return $this->episodes->getOne($episode);
	}

	public function plusNbrComments($episode_id)
	{
		$this->episodes->plusNbrComments($episode_id);
	}

	public function minusNbrComments($episode_id)
	{
		$this->episodes->minusNbrComments($episode_id);
	}
}
