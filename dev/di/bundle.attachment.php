<?php

use Atomino\Bundle\Attachment\Config;
use Atomino\Bundle\Attachment\Img\ImgCreatorInterface;
use function Atomino\cfg;
use function DI\factory;

return [
	ImgCreatorInterface::class => \DI\get(\Atomino\cfg("bundle.attachment.img.creator")),
	Config::class              => factory(fn() => new Config(
		cfg("bundle.attachment.path"),
		cfg("bundle.attachment.url"),
		cfg("bundle.attachment.restricted-access-postfix"),
		cfg("bundle.attachment.img.url"),
		cfg("bundle.attachment.img.path"),
		cfg("bundle.attachment.img.secret"),
		cfg("bundle.attachment.img.jpeg-quality"),
	)),
];