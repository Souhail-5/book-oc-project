<?php
namespace QFram\Helper;

trait Utility
{
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
