<?php

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use function Atomino\cfg;
use function DI\factory;

class_alias(HandlerInterface::class, \Application\SqlLogHandler::class);
class_alias(HandlerInterface::class, \Application\ErrorHandlerMiddlewareLogHandler::class);


return [
	\Application\SqlLogHandler::class                    => factory(fn() => new RotatingFileHandler(cfg("log-handlers.sql.file"), 0, cfg("log-handlers.sql.level"))),
	\Application\ErrorHandlerMiddlewareLogHandler::class => factory(fn() => new RotatingFileHandler(cfg("log-handlers.error-handler-middleware.file"), 0, cfg("log-handlers.error-handler-middleware.level"))),
];