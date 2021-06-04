<?php

use Atomino\Bundle\RLogTail\Debug;
use Atomino\Bundle\RLogTail\RLogTail;
use Atomino\Debug\ErrorHandler;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

return cfg('debug') ? [
	\Atomino\Debug\Debug::class  => factory(fn() => new Debug(dic()->get(RLogTail::class))),
	ErrorHandlerInterface::class => factory(fn() => new ErrorHandler()),
	RLogTail::class              => factory(fn() => new RLogTail(cfg('rlogtail.connection'), cfg('rlogtail.address'))),
] : [];