<?php namespace Application\Admin;

use Atomino\Molecules\Module\Authenticator\Authenticator;
use Atomino\Molecules\Module\Authenticator\SessionAuthenticator;
use function Atomino\dic;

class Router extends \Atomino\RequestPipeline\Router\Router {

	public function route(): void {
		dic()->set(Authenticator::class, dic()->get(\UserAuthenticator::class));
		dic()->get(SessionAuthenticator::class);
		$this(method: 'GET', path: '/')?->pipe(Page\Index::class);
		$this(path: 'api/auth/**')?->pipe(Api\AuthApi::class);
		$this(path: 'magic/article-selector/**')?->pipe(Magic\ArticleMagicSelector::class);
		$this(path: 'magic/user-selector/**')?->pipe(Magic\UserMagicSelector::class);
		$this(path: 'magic/article/**')?->pipe(Magic\ArticleMagic::class);
		$this(path: 'magic/user/**')?->pipe(Magic\UserMagic::class);
	}

}
