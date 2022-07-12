<?php

use Atomino\Bundle\Debug\ChannelFormatter\CliRequestChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\ErrorChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\ExceptionChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\HttpRequestChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\SqlChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\SqlErrorChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\TraceChannelFormatter;
use Atomino\Bundle\Debug\ChannelFormatter\UserChannelFormatter;
use Atomino\Bundle\Debug\CliDebugFormatter;
use Atomino\Bundle\Debug\DebugLogger;
use Atomino\Bundle\Debug\ErrorHandler;
use Atomino\Bundle\Debug\HttpHandler;
use Atomino\Bundle\Debug\StdOutputHandler;
use Atomino\Carbon\Database\Connection;
use Atomino\Core\ApplicationConfig;
use Atomino\Core\BootLoader;
use Atomino\Core\Cli\CliRunner;
use Atomino\Core\Debug\DebugHandlerInterface;
use Atomino\Core\Debug\DebugProxy;
use Atomino\Mercury\HttpRunner;
use DI\Container;
use Monolog\Logger;
use function DI\{decorate, factory};


return [
	DebugHandlerInterface::class => factory(function (ApplicationConfig $cfg) {
		$handler = (new StdOutputHandler($cfg('debug.level')))->setFormatter(new CliDebugFormatter([
			DebugHandlerInterface::DEBUG_CHANNEL_USER => new UserChannelFormatter(),
			Connection::DEBUG_CHANNEL_SQL             => new SqlChannelFormatter(),
			Connection::DEBUG_CHANNEL_SQL_ERROR       => new SqlErrorChannelFormatter(),
			CliRunner::DEBUG_CHANNEL_CLI_REQUEST      => new CliRequestChannelFormatter(),
			HttpRunner::DEBUG_CHANNEL_HTTP_REQUEST    => new HttpRequestChannelFormatter(),
			ErrorHandler::DEBUG_CHANNEL_ERROR         => new ErrorChannelFormatter(),
			ErrorHandler::DEBUG_CHANNEL_EXCEPTION     => new ExceptionChannelFormatter(),
			ErrorHandler::DEBUG_CHANNEL_TRACE         => new TraceChannelFormatter(),
		]));
		$logger = new Logger('', [$handler]);
		return new DebugLogger($logger);
	}),
	BootLoader::class            => decorate(function (BootLoader $bootLoader, Container $c) {
		return $bootLoader
			->add(fn(Container $c) => DebugProxy::setDebugHandler($c->get(DebugHandlerInterface::class)))
			->add(fn(Container $c) => $c->get(ErrorHandler::class)->register())
			;
	}
	),
];
