<?php

use Atomino\Core\Application;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\Config\Builder;
use Atomino\Core\Config\Config;
use Atomino\Core\Config\Loader;
use Atomino\Core\Config\Loader\IniLoader;
use Atomino\Core\Config\Loader\JsonLoader;
use Atomino\Core\Config\Loader\PhpLoader;
use Atomino\Core\Config\Loader\Plugin\EnvPlugin;
use Atomino\Core\Config\Loader\Plugin\PathPlugin;
use DI\Container;
use function DI\factory;


return [
	ApplicationConfig::class => factory(fn(Container $container) => new Config($container->get("app-cfg"))),
	'app-cfg'                =>
		(new Builder(
			(new Loader(new IniLoader(), new JsonLoader(), new PhpLoader()))
				->load(...[...Application::instance()->filterConfigFiles(glob(__DIR__ . "/../config/*.php")), __DIR__ . "/../atomino.ini"])(),
			new PathPlugin(__DIR__ . "/.."),
			new EnvPlugin()
		))(),
];
