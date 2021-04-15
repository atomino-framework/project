<?php namespace Application\Admin\Api;

use Application\Entity\Article;
use Application\Entity\User;
use Atomino\Database\Finder\Filter;
use Atomino\Entity\Entity;
use Atomino\Molecules\Magic\SelectorApi;

class UserSelector extends SelectorApi {
	/** @param User $item */
	protected function value(Entity $item): string { return $item->name; }
	protected function filter(string $search): Filter { return Filter::where(User::name()->like('%' . $search . '%')); }
	protected function order(): array { return ['name', 'asc']; }
	protected function getEntity(): string { return User::class; }
}
