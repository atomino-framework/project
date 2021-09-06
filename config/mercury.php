<?php

return [
	"mercury" => [
		"ratelimiter.path.@path" => "var/tmp/ratelimiter",
		"smart-responder"        => [
			"frontend-version-file.@path" => "var/etc/version",
			"twig.cache-path.@path"       => "var/tmp/cache.smartresponder",
			"twig.debug"                  => \Atomino\Core\Application::instance()->isDev(),
			"twig.namespaces"             => [
				'web.@path'   => 'src/Missions/Web/@templates/',
				'admin.@path' => 'src/Missions/Admin/@templates/',
				'gold.@path' => 'src/Missions/Gold/@templates/',
			],
		],
		"middlewares"            => ["cache.path.@path" => "var/tmp/cache.middleware/"],
	],
];
