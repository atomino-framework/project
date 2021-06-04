<?php

use Atomino\Bundle\RLogTail\Debug;
use Atomino\Bundle\RLogTail\RLogTail;
use Atomino\Debug\ErrorHandler;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

return [
	RLogTail::class => factory(fn() => new RLogTail(cfg('rlogtail.connection'), cfg('rlogtail.address'))),
];