<?php namespace Application\Admin\Magic;

use Application\Entity\Article;
use Atomino\Molecules\Magic\Attributes\Magic;
use Atomino\Molecules\Magic\SelectorApi;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Entity;

#[Magic(Article::class)]
class ArticleMagicSelector extends SelectorApi {
	/** @param Article $item */
	protected function value(Entity $item): string { return $item->title; }
	protected function filter(string $search): Filter { return Filter::where(Article::title()->like('%' . $search . '%')); }
	protected function order(): array { return ['title', 'desc']; }
}
