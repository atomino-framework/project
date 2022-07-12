<?php

return [
	"carbon" => [
		"entity"   => [
			"namespace" => "Application\\Entity",
			"atoms-namespace" => "Application\\Atoms",
			"memcache"  => [
				"server"    => "memcached://localhost",
				"namespace" => "entity",
				"lifetime"  => 10,
			],
		],
		"database" => [
			"dsn"                => getenv("ATOMINO_DATABASE_DSN"),
			"sql-log-file.@path" => "var/log/sql.log",
			"migration-config"   => [
				"connection"     => \Application\Database\DefaultConnection::class,
				"location.@path" => "etc/migrations/",
				"storage"        => "__migrations",
			],
		],

	],
];