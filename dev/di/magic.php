<?php

use Atomino\Core\Cli\CliRunner;
use function Atomino\cfg;
use function DI\decorate;

return [
	CliRunner::class => decorate(fn(CliRunner $runner) => $runner
		->addCliModule(new \Atomino\Magic\Cli\Magic([
			"entity-namespace" => cfg("carbon.entity.namespace"),
			"api-namespace"    => cfg("magic.api-namespace"),
			"descriptor-path"  => cfg("magic.descriptor-path"),
		]))
	),
];