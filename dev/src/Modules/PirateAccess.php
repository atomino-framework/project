<?php


namespace Application\Modules;


class PirateAccess {
	public static function get(object $obj, string $attribute): mixed {
		$getter = function () use ($attribute) { return $this->$attribute; };
		return \Closure::bind($getter, $obj, get_class($obj))();
	}
	public static function set(object $obj, string $attribute, mixed $value) {
		$setter = function ($value) use ($attribute) { $this->$attribute = $value; };
		\Closure::bind($setter, $obj, get_class($obj))($value);
	}
}