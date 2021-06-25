<?php

use Atomino\Bundle\Attachment\AttachmentConfig;
use Atomino\Bundle\Attachment\Img\ImgCreatorInterface;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\Config\Config;
use function DI\factory;
use function DI\get;


return [
	ImgCreatorInterface::class => factory(fn(ApplicationConfig $cfg) => get($cfg("bundle.attachment.img.creator"))),
	AttachmentConfig::class    => factory(fn(ApplicationConfig $cfg) => new Config($cfg("bundle.attachment"))),
];