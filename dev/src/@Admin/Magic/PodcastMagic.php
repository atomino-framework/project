<?php namespace Application\Admin\Magic;

use Atomino\Magic\Attributes\Magic;
use Atomino\Carbon\Entity;
use Application\Entity\Podcast;
use Atomino\Magic\MagicApi;
use Atomino\Carbon\Database\Finder\Filter;

#[Magic(Podcast::class)]
class PodcastMagic extends MagicApi {

	protected function quickSearch(string $quickSearch): Filter { return parent::quickSearch($quickSearch); }

	protected function getSort(string $sort): array { return parent::getSort($sort); }

	protected function preprocess($data) { return parent::preprocess($data); }

	/**
	 * @param Podcast $item
	 * @param $data
	 */
	protected function postprocess(Entity $item, $data) { parent::postprocess($item, $data); }

}
