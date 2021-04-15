<?php

use function Atomino\path;
use function DI\factory;

return [
	\Composer\Autoload\ClassLoader::class => factory(fn() => include path("vendor/autoload.php")),
];