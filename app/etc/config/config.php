<?php return [
	"database"                 => ["dsn" => "mysql:host=localhost;dbname=atomino;user=root;password=root;charset=UTF8"],
	"auth"                     => ["jwt-key" => "my-awesome-secret-key"],
	"attachment-entity-plugin" => ["img" => ["secret" => "quantumbits"]],
	"smart-responder"          => ["debug" => true],
	"log-handlers"             => ["sql" => ["level" => \Monolog\Logger::DEBUG]],
];
