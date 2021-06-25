<?php

use Application\Entity\User;
use Atomino\Bundle\Authenticate\Authenticator;
use Atomino\Core\ApplicationConfig;
use DI\Container;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Configuration as JwtConfiguration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use function DI\factory;

return [
	JwtConfiguration::class => factory(fn(ApplicationConfig $cfg) => Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText($cfg("bundle.authentication.jwt-key")))),
	Authenticator::class    => factory(fn(Container $c) => new Authenticator($c->get(JwtConfiguration::class), User::class)),
];