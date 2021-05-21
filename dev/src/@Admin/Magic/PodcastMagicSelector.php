<?php namespace Application\Admin\Magic;

use Application\Entity\Podcast;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Entity;
use Atomino\Molecules\Magic\Attributes\Magic;
use Atomino\Molecules\Magic\SelectorApi;

#[Magic(Podcast::class)]
class PodcastMagicSelector extends SelectorApi {
	/** @param Podcast $item */
	protected function value(Entity $item): string { return $item->id; }
	protected function filter(string $search): Filter { return Filter::where(User::id()->like('%' . $search . '%')); }
	protected function order(): array { return ['id', 'asc']; }
}
