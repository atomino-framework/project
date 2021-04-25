<?php

use function Atomino\path;

return ["smart-responder" => [
	"frontend-version-file" => path("app/var/version"),
	"twig-cache"            => path("app/tmp/cache.smartresponder"),
	"debug"                 => false,
	"namespaces"            => [
		'web'   => path('dev/src/@Web/(templates)/'),
		'admin' => path('dev/src/@Admin/(templates)/'),
	],
]];
