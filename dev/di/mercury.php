<?php

use Atomino\Mercury\Responder\Smart\Cache\CacheInterface;
use Atomino\Mercury\Responder\Smart\SmartResponderEnv;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use function Atomino\cfg;
use function DI\factory;

return [
	Request::class           => factory(fn() => Request::createFromGlobals()),
	SessionInterface::class  => factory(fn() => new Session(new NativeSessionStorage(["cookie_httponly" => true]))),
	CacheInterface::class    => factory(fn() => new FilesystemAdapter('', 60, cfg("mercury.middlewares.cache.path"))),
	SmartResponderEnv::class => factory(fn() => (new SmartResponderEnv(
		cfg("mercury.smart-responder.twig-cache"),
		file_exists($file = cfg("mercury.smart-responder.frontend-version-file")) ? filemtime($file) : 0,
		cfg("mercury.smart-responder.debug"),
		cfg("mercury.smart-responder.namespaces")
	))),
];
