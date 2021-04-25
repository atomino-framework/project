<?php namespace Application\Admin;

use Atomino\Molecules\Module\Authenticator\SessionAuthenticator;
use function Atomino\dic;

class Router extends \Atomino\RequestPipeline\Router\Router {

	public function route(): void {
		dic()->get(SessionAuthenticator::class);
		$this(method: 'GET', path: '/')?->pipe(Page\Index::class);
		$this(path: 'api/auth/**')?->pipe(Api\AuthApi::class);
		$this(path: 'api/article-selector/**')?->pipe(Api\ArticleSelector::class);
		$this(path: 'api/user-selector/**')?->pipe(Api\UserSelector::class);
		$this(path: 'magic/article/**')?->pipe(Magic\ArticleMagic::class);
		$this(path: 'magic/user/**')?->pipe(Magic\UserMagic::class);
	}

}
