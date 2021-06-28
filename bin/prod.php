<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\Runner\HttpRunnerInterface;

require __DIR__ . "/../vendor/autoload.php";

new Application(
	__DIR__ . "/../dev/di/*.php",
	__DIR__ . "/../app/etc/CompiledContainer.php",
	Application::MODE_PROD,
	__DIR__ . "/..",
	BootLoaderInterface::class,
	HttpRunnerInterface::class
);