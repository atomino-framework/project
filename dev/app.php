<?php

include __DIR__ . "/../vendor/autoload.php";

putenv("ROOT=".realpath(__DIR__.'/../'));

new Atomino\Core\Application(
	include __DIR__ . "/../dev/config/config.php",
	include __DIR__ . "/../dev/config/di.php"
);