<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use function DI\factory;

return [
	Request::class          => factory(fn() => Request::createFromGlobals()),
	SessionInterface::class => factory(fn() => new Session(new NativeSessionStorage(['cookie_httponly' => true]))),
];