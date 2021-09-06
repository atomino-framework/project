<?php

use Atomino\Bundle\Attachment\AttachmentConfig;
use Atomino\Bundle\Attachment\Img\ImgCreatorInterface;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\Config\Config;
use function DI\factory;

return [
	AttachmentConfig::class    => factory(fn(ApplicationConfig $cfg) => new Config($cfg("bundle.attachment"))),
	ImgCreatorInterface::class => factory(fn(AttachmentConfig $cfg, \DI\Container $c) => $c->get($cfg("img.creator"))),
];