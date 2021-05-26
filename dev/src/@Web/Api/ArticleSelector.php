<?php namespace Application\Web\Api;

use Application\Entity\Article;
use Atomino\Molecules\Magic\SelectorApi;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;

class ArticleSelector extends SelectorApi {
	/** @param Article $item */
	protected function value(Entity $item): string { return $item->title; }
	protected function filter(string $search): Filter { return Filter::where(Article::title()->like('%' . $search . '%')); }
	protected function order(): array { return ['title', 'desc']; }
	protected function getEntity(): string { return Article::class; }
}
