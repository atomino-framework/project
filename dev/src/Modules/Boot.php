<?php namespace Application\Modules;

use Atomino\Bundle\RLogTail\RLogTail;
use Atomino\Core\BootInterface;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\dic;

class Boot implements BootInterface {
	public function boot() {
		if (dic()->has(ErrorHandlerInterface::class)) dic()->get(ErrorHandlerInterface::class)?->register();
		if (dic()->has(RLogTail::class)) dic()->get(RLogTail::class)?->register();
	}
}