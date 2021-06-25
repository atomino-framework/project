<?php namespace Application\Admin;

use Atomino\Bundle\Authenticate\SessionAuthenticator;
use function Atomino\dic;

class Router extends \Atomino\Mercury\Router\Router {

	public function __construct(SessionAuthenticator $sessionAuthenticator) { }

	public function route(): void {
		$this(method: 'GET', path: '/')?->pipe(Page\Index::class);
		$this(path: 'api/auth/**')?->pipe(Api\AuthApi::class);
		$this(path: 'magic/user-selector/**')?->pipe(Magic\UserMagicSelector::class);
		$this(path: 'magic/user/**')?->pipe(Magic\UserMagic::class);
	}

}
