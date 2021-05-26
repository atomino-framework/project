<?php

use Application\Entity\User;
use Atomino\Bundle\Authenticate\Authenticator;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Configuration as JwtConfiguration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

return [
	JwtConfiguration::class => factory(fn() => Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(cfg("auth.jwt-key")))),
	Authenticator::class    => factory(fn() => new Authenticator(dic()->get(JwtConfiguration::class), User::class)),
];