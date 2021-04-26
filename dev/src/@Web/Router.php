<?php namespace Application\Web;

use Atomino\Molecules\Module\Authenticator\SessionAuthenticator;
use Atomino\RequestPipeline\Responder\Smart\Cache\Middleware\Cache;

class Router extends \Atomino\RequestPipeline\Router\Router {

	public function __construct(protected SessionAuthenticator $authenticator) { }

	public function route():void{
		$this(method: 'GET', path: '/')?->pipe(Cache::class)->pipe(Page\Index::class);
		$this(path: 'api/auth/**')?->pipe(Api\AuthApi::class);
		$this(path: 'api/article-selector/**')?->pipe(Api\ArticleSelector::class);
		$this(path: 'magic/article/**')?->pipe(Magic\ArticleMagic::class);
	}

}
