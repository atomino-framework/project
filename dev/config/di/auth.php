<?php

use Application\Entity\User;
use Atomino\Molecules\Module\Authenticator\Authenticator;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Configuration as JwtConfiguration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use function Atomino\cfg;
use function Atomino\dic;
use function DI\factory;

class_alias(Authenticator::class, UserAuthenticator::class);
class_alias(Authenticator::class, ArticleAuthenticator::class);


return [
	JwtConfiguration::class => factory(fn() => Configuration::forSymmetricSigner(new Sha256(), InMemory::plainText(cfg("auth.jwt-key")))),
	UserAuthenticator::class    => factory(fn() => new Authenticator(dic()->get(JwtConfiguration::class), User::class)),
	ArticleAuthenticator::class    => factory(fn() => new Authenticator(dic()->get(JwtConfiguration::class), \Application\Entity\Article::class)),
];