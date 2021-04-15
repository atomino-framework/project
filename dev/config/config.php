<?php return array_replace_recursive(
	["settings"=>[]],
	...array_map(fn($file) => include $file, glob(__DIR__ . "/config/*.php")),
	...array_map(fn($file) => include $file, glob(__DIR__ . "/../../app/etc/config/*.php")),
);
