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

		if (!preg_match('#^[0-9]{0,999}$#', $episode->number()))
			$error[] = "Le numéro de l'épisode ne doit pas être supérieur 999.";
		if (!preg_match('#^[0-9]{0,999}$#', $episode->part()))
			$error[] = "Le numéro de partie ne doit pas être supérieur 999.";
		if (!preg_match('#^(.){0,255}$#', $episode->title()))
			$error[] = "La longueur du titre de l'épisode ne doit pas dépasser 255 caractères.";
		if (!preg_match('#^[a-z0-9-]{0,255}$#', $episode->slug()))
			$error[] = "Le slug de l'épisode doit contenir que des caractères alphanumérique en minuscule et tiret (-). Maximum : 255 caractères.";

		if (!empty($error)) throw new \InvalidArgumentException(implode('<br>', $error));

		$episode->setNumber(!empty($episode->number()) ? $episode->number() : 0);
		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setTitle(!empty($episode->title()) ? $episode->title() : 'Sans titre');
		$episode->setSlug(!empty($episode->slug()) ? $episode->slug() : $this->slugify($episode->title()));
		$episode->setText(!empty($episode->text()) ? $episode->text() : 'Il était une fois ...');

		try {
			return $this->episodes->add($episode, $publish);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function update(Object\Episode $episode, $publish=false)
	{
		$error = [];

		if (!preg_match('#^[0-9]{0,999}$#', $episode->number()))
			$error[] = "Le numéro de l'épisode doit être compris entre 0 et 999.";
		if (!preg_match('#^[0-9]{0,999}$#', $episode->part()))
			$error[] = "Le numéro de partie de l'épisode doit être compris entre 0 et 999.";
		if (!preg_match('#^(.){0,255}$#', $episode->title()))
			$error[] = "La longueur du titre de l'épisode ne doit pas dépasser 255 caractères.";
		if (!preg_match('#^[a-z0-9-]{0,255}$#', $episode->slug()))
			$error[] = "Le slug de l'épisode doit contenir que des caractères alphanumérique en minuscule et tiret (-). Maximum : 255 caractères.";

		if (!empty($error)) throw new \InvalidArgumentException(implode('<br>', $error));

		$episode->setNumber(!empty($episode->number()) ? $episode->number() : 0);
		$episode->setPart(!empty($episode->part()) ? $episode->part() : 0);
		$episode->setTitle(!empty($episode->title()) ? $episode->title() : 'Sans titre');
		$episode->setSlug(!empty($episode->slug()) ? $episode->slug() : $this->slugify($episode->title()));
		$episode->setTrash(!empty($episode->trash()) ? $episode->trash() : 0);

		try {
			$this->episodes->update($episode);
			if ($publish === true) $this->episodes->publish($episode);
		} catch (\Exception $e) {
			throw $e;
		}
	}

	public function trashOne(Object\Episode $episode)
	{
		$episode->setTrash(1);
		$this->episodes->update($episode);
	}

	public function untrashOne(Object\Episode $episode)
	{
		$episode->setTrash(0);
		$this->episodes->update($episode);
	}

	public function deleteOne(Object\Episode $episode)
	{
		$this->episodes->deleteOne($episode);
	}

	public function countAllPublish()
	{
		return $this->episodes->countAllPublish();
	}

	public function getAllPublish($page, $limit)
	{
		return $this->episodes->getAllPublish($page, $limit);
	}

	public function countAllDraft()
	{
		return $this->episodes->countAllDraft();
	}

	public function getAllDraft($page, $limit)
	{
		return $this->episodes->getAllDraft($page, $limit);
	}

	public function getAllTrash()
	{
		return $this->episodes->getAllTrash();
	}

	public function getOne(Object\Episode $episode)
	{
		try {
			return $this->episodes->getOne($episode);
		} catch (\Exception $e) {
			throw $e;
		}
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
