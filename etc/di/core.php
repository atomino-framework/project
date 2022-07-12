<?php

use Atomino\Core\Application;
use Atomino\Core\BootLoader;
use Atomino\Core\BootLoaderInterface;
use Atomino\Core\PathResolverInterface;
use Atomino\Neutrons\CodeFinder;
use Atomino\Neutrons\CodeFinderInterface;
use function DI\{factory, get};

return [
	CodeFinderInterface::class   => factory(fn(PathResolverInterface $pathResolver) => new CodeFinder(require $pathResolver->path('vendor/autoload.php'))),
	BootLoaderInterface::class   => get(BootLoader::class),
	PathResolverInterface::class => factory(fn() => new \Atomino\Core\PathResolver(getenv("ATOMINO_ROOT"))),
];
