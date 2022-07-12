<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\Runner\CliRunnerInterface;

(function ($root) {
	require "$root/vendor/autoload.php";
	new Application(
		$root,
		"$root/etc/.env",
		"$root/etc/di/*.php",
		null,
		BootLoaderInterface::class,
		CliRunnerInterface::class
	);
})(realpath(__DIR__ . "/../.."));

