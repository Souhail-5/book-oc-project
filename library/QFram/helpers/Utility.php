<?php
namespace QFram\Helper;

trait Utility
{
	public function hydrate(array $data)
	{
		foreach ($data as $property => $value) {
			$method = 'set'.ucfirst($property);
			if (method_exists($this, $method)) $this->$method($value);
		}
	}

	public function _ifNotEmpty($test, $notEmpty, $empty='')
	{
		if (!empty($test)) {
			return $notEmpty;
		}
		return $empty;
	}

	public function _ifPlural($value, $plural, $singular='')
	{
		if ($value > 1) {
			return $plural;
		}
		if (!empty($singular)) {
			return $singular;
		}
	}
}
