<?php

use Application\Database\DefaultConnection;
use Atomino\Carbon\Database\Connection;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

class_alias(Connection::class, DefaultConnection::class);

return [
	DefaultConnection::class => factory(fn() => new Connection(
		cfg("database.dsn"),
		new ArrayAdapter(),
		new Logger("SQL", [
			dic()->get(\Application\SqlLogHandler::class),
			dic()->get(\Application\ErrorHandlerMiddlewareLogHandler::class),
		])
	)),
	"migration-config"       => factory(fn() => [
		"connection" => dic()->get(cfg("database.migration-config.connection")),
		"location"   => cfg("database.migration-config.location"),
		"storage"    => cfg("database.migration-config.storage"),
	]),
];