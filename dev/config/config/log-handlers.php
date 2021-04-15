<?php

use Monolog\Logger;
use function Atomino\path;

return ['log-handlers' => [
	"sql"                      => ["file" => path("app/var/log/sql.log"), "level" => Logger::ERROR],
	"error-handler-middleware" => ["file" => path("app/var/log/error.log"), "level" => Logger::ERROR],
]];