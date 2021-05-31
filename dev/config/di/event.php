<?php

use Symfony\Component\EventDispatcher\EventDispatcher;
use function DI\factory;

return [EventDispatcher::class => factory(fn() => new EventDispatcher())];