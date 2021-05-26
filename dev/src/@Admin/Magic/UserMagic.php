<?php namespace Application\Admin\Magic;

use Application\Entity\User;
use Atomino\Carbon\Entity;
use Atomino\Magic\Attributes\Magic;
use Atomino\Magic\MagicApi;
use Atomino\Carbon\Database\Finder\Filter;

#[Magic(User::class)]
class UserMagic extends MagicApi {

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
		if(array_key_exists('setpassword', $data ) && $data['setpassword']) $item->setPassword($data['setpassword']);
	}

}
