<?php

use Atomino\Bundle\Debug\Debug;
use Atomino\Bundle\Debug\RLogTail;
use Atomino\Bundle\Debug\Alert;
use Atomino\Bundle\Debug\Telegram;
use Atomino\Debug\ErrorHandler;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

if(cfg('debug.mode') == "debug") return [
	\Atomino\Debug\Debug::class  => factory(fn() => new Debug(dic()->get(RLogTail::class))),
	ErrorHandlerInterface::class => factory(fn() => new ErrorHandler()),
	RLogTail::class => factory(fn() => new RLogTail(cfg('debug.rlogtail.connection'), cfg('debug.rlogtail.address')))
];
if(cfg('debug.mode') == "alert") return [
	\Atomino\Debug\Debug::class => factory(fn() => new Alert(dic()->get(Telegram::class))),
	Telegram::class => factory(fn() => new Telegram(cfg('debug.telegram.botId'), cfg('debug.telegram.channel')))
];
return [];