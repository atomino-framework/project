<?php namespace Application\Admin\Magic;

use Atomino\Magic\Attributes\Magic;
use Atomino\Carbon\Entity;
use Application\Entity\Article;
use Atomino\Magic\MagicApi;
use Atomino\Carbon\Database\Finder\Filter;

#[Magic(Article::class)]
class ArticleMagic extends MagicApi{

	protected function quickSearch(string $quickSearch): Filter {
		return Filter::where(Article::title()->like('%' . $quickSearch . '%'));

	}
	protected function getSort(string $sort): array { return parent::getSort($sort); }
	protected function preprocess($data) { return parent::preprocess($data); }
	/**
	 * @param Article $item
	 * @param $data
	 */
	protected function postprocess(Entity $item, $data) { parent::postprocess($item, $data); }

}