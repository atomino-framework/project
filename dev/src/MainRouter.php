<?php namespace Application;

use Atomino\Mercury\Plugins\Attachment\ImgServer;
use Atomino\Mercury\Plugins\Attachment\AttachmentServer;
use Atomino\Mercury\FileServer\StaticServer;
use Atomino\Mercury\Responder\Redirect;
use Atomino\Mercury\Router\Router;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Contracts\EventDispatcher\Event;
use function Atomino\alert;
use function Atomino\cfg;
use function Atomino\path;

class MainRouter extends Router {

	public function __construct() { }

	protected function route(): void {

		$request = $this->request;
		$domain = cfg('domain');
		
		if (!str_starts_with($request->server->get("SERVER_SOFTWARE", "other"), "Apache/")) {
			AttachmentServer::route($this);
			StaticServer::route($this, '/~web/**', path('/app/public/~web'));
			StaticServer::route($this, '/~admin/**', path('/app/public/~admin'));
			StaticServer::route($this, '/~favicon/**', path('/app/public/~favicon'));
		}
		ImgServer::route($this);
		$this(host: 'admin.' . $domain)?->pipe(Admin\Router::class);
		$this(host: $domain)?->pipe(Web\Router::class);
		$this(host: 'api.' . $domain)?->pipe(Api\Router::class);
		$this(host: 'www.' . $domain)->pipe(...Redirect::setup($request->getScheme() . '://' . $domain));
	}
}