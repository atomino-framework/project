<?php

return [
	"mercury" => [
		"smart-responder" => [
			"frontend-version-file.@path" => "var/etc/version",
			"twig.cache-path.@path"       => "var/tmp/cache.smartresponder",
			"twig.debug"                       => \Atomino\Core\Application::isDev(),
			"twig.namespaces"                  => [
				'web.@path'   => 'src/Missions/Web/@templates/',
				'admin.@path' => 'src/Missions/Admin/@templates/',
			],
		],
		"middlewares"     => ["cache.path.@path" => "var/tmp/cache.middleware/"],
	],
];
