<?php namespace Application\Missions\Admin;

use Application\Missions\Admin\Api\AuthApi;
use Application\Missions\Admin\Api\DashboardApi;
use Application\Missions\Admin\Api\UserApi;
use Atomino\Bundle\Authenticate\SessionAuthenticator;
use Atomino\Mercury\Responder\Smart\Cache\Middleware\Cache;

class Router extends \Atomino\Mercury\Router\Router {

	public function __construct(protected SessionAuthenticator $authenticator) { }

	public function route():void{
		$this(method: 'GET', path: '/')?->pipe(Cache::class)->pipe(Page\Index::class);
		$this(path: '/api/auth/**')?->pipe(AuthApi::class);
		$this(path: '/api/dashboard/**')?->pipe(DashboardApi::class);
		$this(path: '/api/user/**')?->pipe(UserApi::class);
	}

}
