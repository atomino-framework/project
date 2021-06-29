<?php namespace Application\Missions\Api;

class Router extends \Atomino\Mercury\Router\Router {
	public function route(): void {
		$this(path: 'user/**')?->pipe(Api\UserApi::class);
	}
}
