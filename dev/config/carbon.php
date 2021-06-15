<?php

return [
	"carbon"=>[
		"entity"=>[
			"namespace" => "Application\\Entity",
			"memcache"=>[
				"server"=>"memcached://localhost",
				"namespace"=>"entity",
				"lifetime"=>10
			]
		],
		"database"         => [
			"dsn"              => "mysql:host=;dbname=;user=;password=;charset=UTF8",
			"sql-log-file"     => \Atomino\path("app/log/sql.log"),
			"migration-config" => [
				"connection" => \Application\Database\DefaultConnection::class,
				"location"   => \Atomino\path("dev/migrations/"),
				"storage"    => "__migrations",
			],
		],

	]
];