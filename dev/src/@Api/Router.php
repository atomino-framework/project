<?php namespace Application\Api;

use Atomino\Core\Application;
use Atomino\Bundle\Authenticate\ApiAuthenticator;
use function Atomino\dic;

class Router extends \Atomino\Mercury\Router\Router {

	public function route():void{
		dic()->get(ApiAuthenticator::class);
		$this(path: 'user/**')?->exec(Api\UserApi::class);
	}

}
