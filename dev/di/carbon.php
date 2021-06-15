<?php

use Application\Database\DefaultConnection;
use Atomino\Carbon\Cache;
use Atomino\Carbon\Database\Connection;
use Atomino\Core\Cli\CliRunner;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use function Atomino\cfg;
use function DI\{factory, get};


class_alias(Connection::class, DefaultConnection::class);

return [
	DefaultConnection::class => factory(fn() => new Connection(
		cfg("carbon.database.dsn"),
		new ArrayAdapter(),
		new Logger("SQL", [new RotatingFileHandler(cfg("carbon.database.sql-log-file"))])
	)),
	Cache::class     => \DI\get(ArrayAdapter::class), //new MemcachedAdapter(MemcachedAdapter::createConnection(cfg("carbon.entity.memcached.server")), cfg('appid).'.'.cfg("carbon.entity.memcached.namespace"), cfg("carbon.entity.memcached.lifetime"))
	CliRunner::class => \DI\decorate(fn(CliRunner $runner) => $runner
		->addCliModule(new \Atomino\Carbon\Cli\Entity(["namespace" => cfg("carbon.entity.namespace")]))
		->addCliModule(new \Atomino\Carbon\Database\Cli\Migrator([
			"connection" => get(cfg("carbon.database.migration-config.connection")),
			"location"   => cfg("carbon.database.migration-config.location"),
			"storage"    => cfg("carbon.database.migration-config.storage"),
		]))
	),
];