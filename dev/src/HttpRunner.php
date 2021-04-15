<?php namespace Application;

use Atomino\Molecules\Module\Attachment\AttachmentServer;
use Atomino\Molecules\Module\Attachment\Img\ImageServer;
use Atomino\Molecules\Responder\FileServer\StaticServer;
use Atomino\Responder\Error;
use Atomino\Routing\Router;
use function Atomino\path;

class HttpRunner extends Router {

	public function run(): void {

		if(!str_starts_with($this->getRequest()->server->get("SERVER_SOFTWARE", "other"), "Apache/")){
			AttachmentServer::route($this);
			StaticServer::route($this, '/~web/**', path('/app/public/~web'));
			StaticServer::route($this, '/~admin/**', path('/app/public/~admin'));
			StaticServer::route($this, '/~favicon/**', path('/app/public/~favicon'));
		}

		ImageServer::route($this);
		$this(host: 'admin.**')?->pass(Admin\Router::class);
		$this(host: 'www.**')?->pass(Web\Router::class);
		$this(host: 'api.**')?->pass(Api\Router::class);
		$this()->exec(Error::setup(404));
	}
}
