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


class Entry {
	public function __construct(
		public string $message,
		public array|null $context,
		public string $level,
		public string $channel,
		public string $timestamp
	) {
	}
}

abstract class LogViewer {
	abstract function show(Entry $entry, InputInterface $input, OutputInterface $output);
}

class LogViewerUser extends LogViewer {
	public function show(Entry $entry, InputInterface $input, OutputInterface $output) {
		$style = new Style($input, $output);
		$style->write("<bg=#c0392b;options=bold> " . $entry->channel . " </> ");
		$style->writeln($entry->message);
		if (!is_null($entry->context)) {
			$style->writeln(json_encode($entry->context, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES|JSON_PRETTY_PRINT));
		}
		$style->writeln('');
	}
}

class SqlViewerUser extends LogViewer {
	public function show(Entry $entry, InputInterface $input, OutputInterface $output) {
		$style = new Style($input, $output);
		$style->write("<bg=163;fg=#000000;options=bold> " . $entry->channel . " </>");
		$style->writeln($entry->message);
		$style->writeln('');
	}
}

class Tail extends Command {

	/** @var LogViewer[] */
	private array $viewers;

	public function __construct(private PathResolverInterface $pathResolver) {
		parent::__construct("tail");
		$this->viewers['USER'] = new LogViewerUser();
		$this->viewers['SQL'] = new SqlViewerUser();
	}

	protected function execute(InputInterface $input, OutputInterface $output) {

		$path = $this->pathResolver->path("/rlogtail.sock");
		if (file_exists($path)) unlink($path);

		$loop = new Loop(new SelectLoop());
		$server = new SocketListener('unix://' . $path, $loop);

		$server->on('connect', function ($server, SocketInterface $client) use ($input, $output) {
			$client->on('data', function (SocketInterface $client, $data) use ($input, $output) {
				$records = explode("\n", $data);
				foreach ($records as $line) if (trim($line)) {
					$record = json_decode($line, true);
					$entry = new Entry(
						$record['message'],
						array_key_exists('context', $record) ? $record['context'] : null,
						$record['level_name'],
						$record['channel'],
						$record['datetime'],
					);
					if (array_key_exists($record['channel'], $this->viewers)) $this->viewers[$record['channel']]->show($entry, $input, $output);
				}
			});
		});

		$loop->onStart(function () use ($server) {
			$server->start();
		});
		$loop->start();
		return 1;
	}

}
