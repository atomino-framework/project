<?php namespace Application;

use Atomino\Molecules\Module\Attachment\Server\AttachmentServer;
use Atomino\Molecules\Module\Attachment\Server\ImgServer;
use Atomino\RequestPipeline\FileServer\StaticServer;
use Atomino\RequestPipeline\Router\Router;
use function Atomino\path;

class MainRouter extends Router {
	protected function route(): void {
		$request = $this->request;
		if (!str_starts_with($request->server->get("SERVER_SOFTWARE", "other"), "Apache/")) {
			AttachmentServer::route($this);
			StaticServer::route($this, '/~web/**', path('/app/public/~web'));
			StaticServer::route($this, '/~admin/**', path('/app/public/~admin'));
			StaticServer::route($this, '/~favicon/**', path('/app/public/~favicon'));
		}
		ImgServer::route($this);
		$this(host: 'admin.**')?->pipe(Admin\Router::class);
		$this(host: 'www.**')?->pipe(Web\Router::class);
	}
}