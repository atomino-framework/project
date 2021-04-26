<?php namespace Application;

use Atomino\Core\Runner\HttpRunnerInterface;
use Atomino\Molecules\Module\Attachment\Server\AttachmentServer;
use Atomino\Molecules\Module\Attachment\Server\ImgServer;
use Atomino\RequestPipeline\FileServer\StaticServer;
use Atomino\RequestPipeline\Middleware\Emitter;
use Atomino\RequestPipeline\Pipeline\Pipeline;
use Atomino\RequestPipeline\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use function Atomino\dic;
use function Atomino\path;

class HttpRunner implements HttpRunnerInterface {

	public function run(): void {

		$request = dic()->get(Request::class);

		$router = Router::create(function (Router $router) use ($request) {
			if(!str_starts_with($request->server->get("SERVER_SOFTWARE", "other"), "Apache/")){
				AttachmentServer::route($router);
				StaticServer::route($router, '/~web/**', path('/app/public/~web'));
				StaticServer::route($router, '/~admin/**', path('/app/public/~admin'));
				StaticServer::route($router, '/~favicon/**', path('/app/public/~favicon'));
			}
			ImgServer::route($router);
			$router(host: 'admin.**')?->pipe(Admin\Router::class);
			$router(host: 'www.**')?->pipe(Web\Router::class);
		});

		(new Pipeline())
			->pipe(Emitter::class)
			->pipe($router)
			->execute($request)
		;
	}
}
