<?php namespace Application\Admin\Magic;

use Application\Entity\User;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Entity;
use Atomino\Molecules\Magic\Attributes\Magic;
use Atomino\Molecules\Magic\SelectorApi;

#[Magic(User::class)]
class UserMagicSelector extends SelectorApi {
	/** @param User $item */
	protected function value(Entity $item): string { return $item->name; }
	protected function filter(string $search): Filter { return Filter::where(User::name()->like('%' . $search . '%')); }
	protected function order(): array { return ['name', 'asc']; }
}
