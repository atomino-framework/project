<?php namespace Application\Modules;

use Atomino\Core\BootInterface;
use Atomino\Debug\ErrorHandlerInterface;
use function Atomino\dic;

class Boot implements BootInterface {
	public function boot() {
		dic()->has(ErrorHandlerInterface::class) && dic()->get(ErrorHandlerInterface::class)?->register();
	}
}