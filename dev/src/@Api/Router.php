<?php namespace Application\Api;

use Atomino\Core\Application;
use Atomino\Molecules\Module\Authenticator\ApiAuthenticator;
use function Atomino\dic;

class Router extends \Atomino\Routing\Router{

	public function run():void{
		dic()->get(ApiAuthenticator::class);
		$this(path: 'user/**')?->exec(Api\UserApi::class);
	}

}
