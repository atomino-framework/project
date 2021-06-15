<?php

use Atomino\Core\Cli\CliRunner;
use function DI\decorate;

return [
	CliRunner::class => decorate(fn(CliRunner $runner) => $runner),
];