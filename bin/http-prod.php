<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\Runner\HttpRunnerInterface;

require __DIR__ . "/../vendor/autoload.php";

new Application(
	__DIR__ . "/../{di,di/prod}/*.php",
	__DIR__ . "/../var/etc/CompiledContainer.php",
	Application::MODE_PROD,
	__DIR__ . "/..",
	BootLoaderInterface::class,
	HttpRunnerInterface::class
);
