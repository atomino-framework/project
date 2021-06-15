<?php

use Atomino\Core\Cli\CliRunner;
use Atomino\Core\Runner\CliRunnerInterface;
use Atomino\Core\Runner\HttpRunnerInterface;
use Composer\Autoload\ClassLoader;
use function Atomino\path;
use function DI\{decorate, factory, get};

return [
	ClassLoader::class         => factory(fn() => include path("vendor/autoload.php")),
	CliRunnerInterface::class  => get(CliRunner::class),
	HttpRunnerInterface::class => get(\Atomino\Mercury\HttpRunner::class),
	CliRunner::class => decorate(fn(CliRunner $runner) => $runner
		->addCliModule(new \Atomino\Core\CoreCli())
	),
];