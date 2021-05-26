<?php namespace Application\Admin\Magic;

use Application\Entity\Article;
use Atomino\Magic\Attributes\Magic;
use Atomino\Magic\SelectorApi;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;

#[Magic(Article::class)]
class ArticleMagicSelector extends SelectorApi {
	/** @param Article $item */
	protected function value(Entity $item): string { return $item->title; }
	protected function filter(string $search): Filter { return Filter::where(Article::title()->like('%' . $search . '%')); }
	protected function order(): array { return ['title', 'desc']; }
}
