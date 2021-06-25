<?php


namespace Application\Modules;


use Atomino\Core\Cli\Style;
use Atomino\Core\PathResolverInterface;
use Kraken\Ipc\Socket\SocketInterface;
use Kraken\Ipc\Socket\SocketListener;
use Kraken\Loop\Loop;
use Kraken\Loop\Model\SelectLoop;
use Lowlight\Lowlight;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Cursor;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Terminal;
use Amp\ByteStream\IteratorStream;
use Amp\ByteStream\ResourceOutputStream;
use Amp\Delayed;
use Amp\Http\Server\HttpServer;
use Amp\Http\Server\Options;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Status;
use Amp\Producer;
use Amp\Socket;
use Monolog\Logger;

//class Entry {
//	public function __construct(
//		public string $message,
//		public array|null $context,
//		public string $level,
//		public string $channel,
//		public string $timestamp
//	) {
//	}
//}
//
//abstract class LogViewer {
//	abstract function show(Entry $entry, InputInterface $input, OutputInterface $output);
//}
//
//class LogViewerUser extends LogViewer {
//	public function show(Entry $entry, InputInterface $input, OutputInterface $output) {
//		$style = new Style($input, $output);
//		$style->write("<bg=#c0392b;options=bold> " . $entry->channel . " </> ");
//		$style->writeln($entry->message);
//		if (!is_null($entry->context)) {
//			$style->writeln(json_encode($entry->context, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
//		}
//		$style->writeln('');
//	}
//}
//
//class SqlViewerUser extends LogViewer {
//	public function show(Entry $entry, InputInterface $input, OutputInterface $output) {
//		$style = new Style($input, $output);
//		$style->write("<bg=163;fg=#000000;options=bold> " . $entry->channel . " </>");
//		$style->writeln($entry->message);
//		$style->writeln('');
//	}
//}

class WebTail extends Command {

	/** @var LogViewer[] */
	private array $viewers;

	public function __construct(private PathResolverInterface $pathResolver) {
		parent::__construct("webtail");
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		\Amp\Loop::run(function () {

			$path = $this->pathResolver->path("/rlogtail.sock");
			if (file_exists($path)) unlink($path);

			$servers = [Socket\Server::listen("unix://" . $path),];

			$server = new HttpServer($servers, new CallableRequestHandler(static function (\Amp\Http\Server\Request $request) {
				return new Response(Status::OK, ["content-type" => "text/plain; charset=utf-8"], "!");
			}), new Logger('log', []));

			yield $server->start();

			// Stop the server when SIGINT is received (this is technically optional, but it is best to call Server::stop()).
			\Amp\Loop::onSignal(\SIGINT, static function (string $watcherId) use ($server) {
				\Amp\Loop::cancel($watcherId);
				yield $server->stop();
			});
		});
		return 1;
	}

}
