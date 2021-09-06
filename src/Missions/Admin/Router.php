<?php namespace Application\Missions\Admin;

use Application\Missions\Gold\Api\AuthApi;
use Application\Missions\Gold\Api\UserApi;
use Application\Services\ActualEventService;
use Atomino\Bundle\Authenticate\SessionAuthenticator;
use Atomino\Mercury\Responder\Smart\Cache\Middleware\Cache;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router extends \Atomino\Mercury\Router\Router {

	public function __construct(protected SessionAuthenticator $authenticator) { }

	public function route():void{
		$this(method: 'GET', path: '/')?->pipe(Cache::class)->pipe(Page\Index::class);
		$this(path: '/gold/auth/**')?->pipe(AuthApi::class);
		$this(path: '/gold/user/**')?->pipe(UserApi::class);
	}

}
