<?php

use Atomino\Carbon\Cache;
use Atomino\Bundle\Attachment\Config;
use Atomino\Bundle\Attachment\Img\ImgCreatorInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use function Atomino\cfg;
use function DI\factory;


return [
	Cache::class               => factory(fn() => new ArrayAdapter()), //new MemcachedAdapter(MemcachedAdapter::createConnection('memcached://localhost'), 'entity', 10)
	ImgCreatorInterface::class => factory(fn() => new (cfg("attachment-entity-plugin.img.creator"))()),
	Config::class              => factory(fn() => new Config(
		cfg("attachment-entity-plugin.path"),
		cfg("attachment-entity-plugin.url"),
		cfg("attachment-entity-plugin.restricted-access-postfix"),
		cfg("attachment-entity-plugin.img.url"),
		cfg("attachment-entity-plugin.img.path"),
		cfg("attachment-entity-plugin.img.secret"),
		cfg("attachment-entity-plugin.img.jpeg-quality"),
	)),
	"entity-generator"         => factory(fn() => ["namespace" => cfg("entity-generator.namespace")]),
	"magic"                    => factory(fn() => ["entity-namespace" => cfg("entity-generator.namespace"), "api-namespace" => cfg("magic.api-namespace"), "descriptor-path" => cfg("magic.descriptor-path")]),
];