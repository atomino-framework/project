<?php

use Atomino\Core\ApplicationConfig;
use Atomino\Core\Cli\CliRunner;
use Atomino\Core\Config\Config;
use Atomino\Magic\Cli\Magic;
use DI\Container;
use function DI\decorate;

return [
	CliRunner::class => decorate(function (CliRunner $runner, Container $c) {
		$cfg = $c->get(ApplicationConfig::class);
		return $runner
			->addCliModule($c->make(Magic::class, ['config' => new Config([
				"entity-namespace" => $cfg("carbon.entity.namespace"),
				"api-namespace"    => $cfg("magic.api-namespace"),
				"descriptor-path"  => $cfg("magic.descriptor-path"),
			])]));
	}),
];