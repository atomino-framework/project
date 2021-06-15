<?php

use function Atomino\path;

return [
	"mercury" => [
		"smart-responder" => [
			"frontend-version-file" => path("app/etc/version"),
			"twig-cache"            => path("app/tmp/cache.smartresponder"),
			"debug"                 => false,
			"namespaces"            => [
				'web'   => path('dev/src/@Web/(templates)/'),
				'admin' => path('dev/src/@Admin/(templates)/'),
			],
		],
		"middlewares"     => [
			"cache" => ["path" => path("/app/tmp/cache.middleware/")],
		],
	],
];
