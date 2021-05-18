<?php namespace Application\Admin\Magic;

use Atomino\Molecules\Magic\Attributes\Magic;
use Atomino\Entity\Entity;
use Application\Entity\product;
use Atomino\Molecules\Magic\MagicApi;
use Atomino\Database\Finder\Filter;

#[Magic(product::class)]
class ProductMagic extends MagicApi {

	protected function quickSearch(string $quickSearch): Filter { return parent::quickSearch($quickSearch); }

	protected function getSort(string $sort): array { return parent::getSort($sort); }

	protected function preprocess($data) { return parent::preprocess($data); }

	/**
	 * @param product $item
	 * @param $data
	 */
	protected function postprocess(Entity $item, $data) { parent::postprocess($item, $data); }

}
