<?php

use Atomino\Mercury\HttpRunner;
use function DI\decorate;

return [
	HttpRunner::class => decorate(fn(HttpRunner $runner) => $runner
		->pipe(\Atomino\Mercury\Middleware\Emitter::class)
		->pipe(\Application\MainRouter::class)
	),
];