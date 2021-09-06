<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\Runner\HttpRunnerInterface;

require __DIR__ . "/../vendor/autoload.php";


new Application(
	__DIR__ . "/../{di,di/dev}/*.php",
	null,
	Application::MODE_DEV,
	__DIR__ . "/..",
	BootLoaderInterface::class,
	HttpRunnerInterface::class
);
