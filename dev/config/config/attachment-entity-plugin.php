<?php

use function Atomino\path;

return ["attachment-entity-plugin" => [
	"path" => path("app/data/attachments/"),
	"url"  => "/~fs",
	"restricted-access-postfix" => ".restricted-access",
	"img"  => [
		"jpeg-quality" => 80,
		"url"          => "/~img",
		"path"         => path("app/tmp/img/"),
		"creator"      => \Atomino\Molecules\Module\Attachment\Img\ImgCreatorGD2::class,
		"secret"       => "",
	],
]];