<?php

use function Atomino\path;

return ['database' => [
	"dsn"        => "mysql:host=;dbname=;user=;password=;charset=UTF8",
	"migration-config" => [
		'connection' => \Application\Database\DefaultConnection::class,
		'location'   => path("dev/migrations/"),
		'storage'    => '__migrations',
	],
]];