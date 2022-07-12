<?php

use Atomino\Core\Runner\HttpRunnerInterface;
use Atomino\Mercury\HttpRunner;
use function DI\decorate;
use function DI\get;

return [
	HttpRunnerInterface::class => get(HttpRunner::class),
	HttpRunner::class => decorate(fn(HttpRunner $runner) => $runner
		->pipe(\Atomino\Mercury\Middleware\Logger::class)
		->pipe(\Atomino\Mercury\Middleware\Emitter::class)
		->pipe(\Atomino\Mercury\Middleware\MobileDetector::class)
		->pipe(\Application\Missions\MainRouter::class)
	),
];
