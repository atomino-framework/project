<?php

use Atomino\Bundle\RLogTail\Debug;
use Atomino\Bundle\RLogTail\RLogTail;
use Atomino\Debug\ErrorHandler;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\cfg;
use function DI\factory;

return [
	\Atomino\Debug\Debug::class  => factory(fn() => cfg('debug') ? new Debug(new RLogTail(cfg('rlogtail.connection'), cfg('rlogtail.address'))) : null),
	ErrorHandlerInterface::class => factory(fn() => cfg('debug') ? new ErrorHandler() : null)
];