<?php namespace Application\Admin\Magic;

use Application\Entity\Article;
use Atomino\Molecules\Magic\MagicApi;
use Atomino\Database\Finder\Filter;


class ArticleMagic extends MagicApi {

	protected function getEntity(): string { return Article::class; }

	protected function quickSearch(string $quickSearch): Filter {
		return Filter::where(Article::title()->like('%' . $quickSearch . '%'))->or(Article::id($quickSearch));
	}


}
