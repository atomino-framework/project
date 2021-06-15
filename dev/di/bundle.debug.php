<?php

use Atomino\Core\Debug\DebugHandler;
use Atomino\Core\Debug\ErrorHandlerInterface;
use function Atomino\cfg;
use function DI\factory;
use function DI\get;

return cfg('debug') ? [
	DebugHandler::class          => factory(fn() => new \Atomino\Bundle\Debug\DebugHandler(new \Atomino\Bundle\Debug\RLogTail(cfg('rlogtail.connection'), cfg('rlogtail.address')))),
	ErrorHandlerInterface::class => get(\Atomino\Bundle\Debug\ErrorHandler::class),
] : [];