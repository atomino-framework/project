<?php namespace Application\Admin\Magic;

use Application\Entity\Podcast;
use Application\Entity\User;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Carbon\Entity;
use Atomino\Magic\Attributes\Magic;
use Atomino\Magic\SelectorApi;

#[Magic(Podcast::class)]
class PodcastMagicSelector extends SelectorApi {
	/** @param Podcast $item */
	protected function value(Entity $item): string { return $item->id; }
	protected function filter(string $search): Filter { return Filter::where(User::id()->like('%' . $search . '%')); }
	protected function order(): array { return ['id', 'asc']; }
}
