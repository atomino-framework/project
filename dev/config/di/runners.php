<?php

use Application\CliRunner;
use Application\HttpRunner;
use Atomino\Core\Runner\CliRunnerInterface;
use Atomino\Core\Runner\HttpRunnerInterface;
use function DI\autowire;

return [
	CliRunnerInterface::class  => autowire(CliRunner::class),
	HttpRunnerInterface::class => autowire(HttpRunner::class),
];