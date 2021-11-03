<?php namespace Application\Missions\Admin\Api;

use Application\Entity\User;
use Atomino\Carbon\Entity;

class AuthApi extends \Atomino\Gold\AuthApi {
	public function getAuthenticated(): Entity|User|null { return User::getAuthenticated(); }
	public function getUserName(Entity|User $user): string { return $user->name; }
	public function getUserAvatar(Entity|User $user): string|null { return $user->avatar?->first?->image->crop(64, 64)->png; }
}
