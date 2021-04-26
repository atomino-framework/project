<?php namespace Application;

use Atomino\Core\Runner\HttpRunnerInterface;
use Atomino\RequestPipeline\Middleware\Emitter;
use Atomino\RequestPipeline\Pipeline\Pipeline;

class HttpRunner implements HttpRunnerInterface {
	public function run(): void {
		(new Pipeline())
			->pipe(Emitter::class)
			->pipe(MainRouter::class)
			->execute()
		;
	}
}
