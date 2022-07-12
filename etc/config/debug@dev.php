<?php

return [
	"debug" => [
		"http-url" => "127.0.0.1:" . getenv("ATOMINO_HTTP_LOG_PORT"),
		"level"    => intval(getenv("ATOMINO_DEBUG_LEVEL")),
	],
];