<?php

use Atomino\Molecules\Cache\CacheInterface;
use Atomino\Molecules\Middleware\ErrorHandler\ErrorHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use function Atomino\{cfg, dic};
use function DI\factory;

return [
	ErrorHandler::class   => factory(fn() => new ErrorHandler(new Logger('error', [dic()->get(\Application\ErrorHandlerMiddlewareLogHandler::class)]))),
	CacheInterface::class => factory(fn() => new FilesystemAdapter('', 60, cfg('middlewares.cache.path'))),
];