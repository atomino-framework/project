<?php

return [
	"mercury" => [
		"smart-responder" => [
			"frontend-version-file.@path" => "app/etc/version",
			"twig.cache-path.@path"       => "app/tmp/cache.smartresponder",
			"twig.debug"                       => \Atomino\Core\Application::isDev(),
			"twig.namespaces"                  => [
				'web.@path'   => 'dev/src/@Web/(templates)/',
				'admin.@path' => 'dev/src/@Admin/(templates)/',
			],
		],
		"middlewares"     => ["cache.path.@path" => "/app/tmp/cache.middleware/"],
	],
];
