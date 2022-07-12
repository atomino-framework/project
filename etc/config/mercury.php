<?php

return [
	"mercury" => [
		"ratelimiter.path.@path" => "var/tmp/ratelimiter",
		"session"                => [
			"cookie_httponly" => true,
			"cookie_domain"   => "",
			"name"            => "_SID",
		],
		"smart-responder"        => [
			"frontend-version-file.@path" => "var/etc/version",
			"twig.cache-path.@path"       => "var/tmp/cache.smartresponder",
			"twig.debug"                  => boolval(getenv("ATOMINO_DEV_MODE")),
			"twig.namespaces"             => [
				'web.@path'   => 'src/Missions/Web/@templates/',
				'admin.@path' => 'src/Missions/Admin/@templates/',
			],
		],
		"middlewares"            => ["cache.path.@path" => "var/tmp/cache.middleware/"],
	],
];

