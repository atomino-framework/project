<?php return array_replace_recursive(
	["settings"=>[]],
	...array_map(fn($file) => include $file, glob(__DIR__ . "/config/*.php")),
	...[\Atomino\readini(__DIR__.'/../../atomino.ini')],
);
