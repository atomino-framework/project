<?php

use Atomino\Core\Application;
use function Atomino\path;

require __DIR__ . "/../vendor/autoload.php";
Application::boot(
	Application::createConfigLoader(path("/dev/config/*.php"), path("atomino.ini")),
	Application::createDILoader(path("/dev/di/*.php")),
	path('/app/etc/')
);
