<?php

use Atomino\Core\ApplicationConfig;
use Atomino\Core\Config\Config;
use Atomino\Mercury\Pipeline\Pipeline;
use Atomino\Mercury\Responder\Smart\Cache\CacheInterface;
use Atomino\Mercury\Responder\Smart\SmartResponderConfig;
use DI\Container;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Twig\Cache\FilesystemCache;
use function DI\factory;


return [
	Request::class              => factory(fn() => Request::createFromGlobals()),
	SessionInterface::class     => factory(fn() => new Session(new NativeSessionStorage(["cookie_httponly" => true]))),
	CacheInterface::class       => factory(fn(ApplicationConfig $cfg) => new FilesystemAdapter('', 60, $cfg("mercury.middlewares.cache.path"))),
	SmartResponderConfig::class => factory(fn(ApplicationConfig $cfg) => new Config(array_merge_recursive(
		$cfg("mercury.smart-responder"),
		[
			"frontend-version" => file_exists($file = $cfg("mercury.smart-responder.frontend-version-file")) ? filemtime($file) : 0,
			"twig"             => ["cache" => new FilesystemCache($cfg('mercury.smart-responder.twig.cache-path'))],
		]
	))),
	Pipeline::class             => factory(fn(Request $request, Container $container) => new Pipeline($request, $container)),
];
