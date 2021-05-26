<?php namespace Application;

use Atomino\Core\Runner\HttpRunnerInterface;
use Atomino\Mercury\Middleware\Emitter;
use Atomino\Mercury\Pipeline\Pipeline;

class HttpRunner implements HttpRunnerInterface {
	public function run(): void {
		(new Pipeline())
			->pipe(Emitter::class)
			->pipe(MainRouter::class)
			->execute()
		;
	}
}
