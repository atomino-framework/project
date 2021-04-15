<?php

use function Atomino\path;

return ['database' => [
	"dsn"        => "mysql:host=localhost;dbname=atomino;user=root;password=root;charset=UTF8",
	"migration-config" => [
		'connection' => \Application\Database\DefaultConnection::class,
		'location'   => path("dev/migrations/"),
		'storage'    => '__migrations',
	],
]];