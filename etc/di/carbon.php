<?php

use Application\Database\DefaultConnection;
use Atomino\Carbon\Cache;
use Atomino\Carbon\Database\Connection;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\BootLoader;
use Atomino\Core\Cli\CliRunner;
use DI\Container;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use function DI\{decorate, factory, get};

class_alias(Connection::class, DefaultConnection::class);

return [
	Cache::class             => get(ArrayAdapter::class),
	//	Cache::class => factory(fn(ApplicationConfig $config) => new MemcachedAdapter(
	//		MemcachedAdapter::createConnection(			$config("carbon.entity.memcached.server")),
	//		$config('appid').'.'.$config("carbon.entity.memcached.namespace"),
	//		$config("carbon.entity.memcached.lifetime"))),
	DefaultConnection::class => factory(fn(ApplicationConfig $cfg, Container $c) => new Connection(
		$cfg("carbon.database.dsn"),
		$c->get(Cache::class),
		new Logger("SQL", [new RotatingFileHandler($cfg("carbon.database.sql-log-file"))])
	)),
	CliRunner::class         => decorate(function (CliRunner $runner, Container $c) {
		$cfg = $c->get(ApplicationConfig::class);
		return $runner
			->addCliModule($c->make(\Atomino\Carbon\Cli\Entity::class, ['config' => new \Atomino\Core\Config\Config([
				"namespace" => $cfg('carbon.entity.namespace'),
				"atoms-namespace" => $cfg('carbon.entity.atoms-namespace'),
			])]))
			->addCliModule($c->make(\Atomino\Carbon\Database\Cli\Migrator::class, ['config' => new \Atomino\Core\Config\Config([
				"connection" => $c->get($cfg("carbon.database.migration-config.connection")),
				"location"   => $cfg("carbon.database.migration-config.location"),
				"storage"    => $cfg("carbon.database.migration-config.storage"),
			])]))
			;
	}),
	BootLoader::class        => decorate(fn(BootLoader $bootLoader, Container $c) => $bootLoader
		->add(fn(Container $c) => \Atomino\Carbon\Model::setContainer($c))
	),
];
