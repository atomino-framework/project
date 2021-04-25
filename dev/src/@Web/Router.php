<?php namespace Application\Web;

use Atomino\Core\Application;
use Atomino\Molecules\Module\Authenticator\SessionAuthenticator;
use Atomino\Molecules\Responder\SmartResponder\Cache\Middleware\Cache;
use function Atomino\dic;

class Router extends \Atomino\Routing\Router{

	public function run():void{


		dic()->get(SessionAuthenticator::class);
		$this(method: 'GET', path: '/')?->pipe(Cache::class)->exec(Page\Index::class);
		$this(path: 'api/auth/**')?->exec(Api\AuthApi::class);

		$this(path: 'api/article-selector/**')?->exec(Api\ArticleSelector::class);
		$this(path: 'magic/article/**')?->exec(Magic\ArticleMagic::class);

	}

}
