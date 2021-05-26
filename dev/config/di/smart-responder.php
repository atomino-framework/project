<?php

use Atomino\Mercury\Responder\Smart\SmartResponderEnv;
use function Atomino\cfg;
use function DI\factory;

return [
	SmartResponderEnv::class => factory(
		fn() => (new SmartResponderEnv(
			twigCacheDir: cfg("smart-responder.twig-cache"),
			frontendVersion: file_exists($file = cfg("smart-responder.frontend-version-file")) ? filemtime($file) : 0,
			debug: cfg('smart-responder.debug'),
			namespaces: cfg("smart-responder.namespaces")
		))
	),
];