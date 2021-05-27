<?php

use function Atomino\path;

return ["publish" => [
	"assets" => path("/dev/assets/"),
	"public" => path("/app/public/"),
	"config-cache" => path("/app/var/config.php"),
	"config" => path("/dev/config/config.php"),
]];