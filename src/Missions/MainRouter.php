<?php namespace Application\Missions;

use Atomino\Bundle\Attachment\AttachmentConfig;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\PathResolverInterface;
use Atomino\Core\Runner\HttpRunnerInterface;
use Atomino\Mercury\FileServer\StaticServer;
use Atomino\Mercury\HttpRunner;
use Atomino\Mercury\Plugins\Attachment\AttachmentServer;
use Atomino\Mercury\Plugins\Attachment\ImgServer;
use Atomino\Mercury\Responder\Redirect;
use Atomino\Mercury\Router\Router;
use function Atomino\cfg;
use function Atomino\debug;
use function Atomino\path;

class MainRouter extends Router {

	private string $domain;

	public function __construct(
		ApplicationConfig $config,
		private AttachmentConfig $attachmentConfig,
		private PathResolverInterface $pathResolver
	) {
		$this->domain = $config('domain');
	}

	protected function route(): void {
		if (!str_starts_with($this->request->server->get("SERVER_SOFTWARE", "other"), "Apache/")) {
			AttachmentServer::route($this, $this->attachmentConfig);
			StaticServer::route($this, '/~web/**', $this->pathResolver->path('var/public/~web'));
			StaticServer::route($this, '/~admin/**', $this->pathResolver->path('var/public/~admin'));
			StaticServer::route($this, '/~favicon/**', $this->pathResolver->path('var/public/~favicon'));
			StaticServer::route($this, '/~fonts/**', $this->pathResolver->path('var/public/~fonts'));
		}
		ImgServer::route($this, $this->attachmentConfig);

		$this(host: 'admin.' . $this->domain)?->pipe(Admin\Router::class);
		$this(host: $this->domain)?->pipe(Web\Router::class);
		$this(host: 'api.' . $this->domain)?->pipe(Api\Router::class);
		$this(host: 'www.' . $this->domain)?->pipe(...Redirect::setup($this->request->getScheme() . '://' . $this->domain . (($port = $this->request->getPort()) !== 80 ? ':' . $port : '')));
	}
}
