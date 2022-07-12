<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\Runner\HttpRunnerInterface;

(function ($root) {
	require "$root/vendor/autoload.php";
	new Application(
		$root,
		"$root/etc/.env",
		"$root/etc/di/*.php",
		"$root/var/tmp/CompiledContainer.php",
		BootLoaderInterface::class,
		HttpRunnerInterface::class
	);
})(realpath(__DIR__ . "/../.."));