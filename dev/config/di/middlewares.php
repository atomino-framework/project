<?php

use Application\ErrorHandlerMiddlewareLogHandler;
use Application\ExceptionHandlerMiddlewareLogHandler;
use Atomino\Mercury\Middleware\ErrorHandler;
use Atomino\Mercury\Middleware\ExceptionHandler;
use Atomino\Mercury\Responder\Smart\Cache\CacheInterface;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use function Atomino\{cfg, dic};
use function DI\factory;

return [
	ExceptionHandler::class => factory(fn() => new ExceptionHandler(new Logger('error', [dic()->get(ErrorHandlerMiddlewareLogHandler::class)]))),
	ErrorHandler::class     => factory(fn() => new ErrorHandler(new Logger('error', [dic()->get(ExceptionHandlerMiddlewareLogHandler::class)]))),
	CacheInterface::class   => factory(fn() => new FilesystemAdapter('', 60, cfg('middlewares.cache.path'))),
];