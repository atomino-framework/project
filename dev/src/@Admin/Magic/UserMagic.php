<?php namespace Application\Admin\Magic;

use Application\Entity\Article;
use Application\Entity\User;
use Atomino\Entity\Entity;
use Atomino\Molecules\Magic\MagicApi;
use Atomino\Database\Finder\Filter;


class UserMagic extends MagicApi {

	protected function getEntity(): string { return User::class; }

	protected function quickSearch(string $quickSearch): Filter {
		return Filter::where(User::name()->like('%' . $quickSearch . '%'))->or(User::id($quickSearch));
	}

	protected function preprocess($data){
		$data['name'] = strtoupper($data['name']);
		return $data;
	}

	/**
	 * @param User $item
	 * @param $data
	 */
	protected function postprocess(Entity $item, $data) {
		if($data['setpassword']) $item->setPassword($data['setpassword']);
	}

}
