<?php


namespace Application\Modules;


use Amp\Http\Server\Request;
use Application\Entity\User;
use Atomino\Core\PathResolverInterface;
use League\CLImate\Argument\Filter;
use League\CLImate\CLImate;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\SocketHandler;
use Monolog\Logger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpClient\HttpClient;
use function Atomino\debug;

class Test extends Command {

	public function __construct(private PathResolverInterface $pathResolver) {
		parent::__construct("test");
	}

	protected function execute(InputInterface $input, OutputInterface $output) {

		$cli = new CLImate();
		$cli->to("buffer");

		$style = $cli->backgroundLightYellow()->bold()->black()->underline();
		$text = $style->out("reweww");

		$message = $text->output->get("buffer")->get();
//
//		$ch = curl_init();
//		curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:10000");
//		curl_setopt($ch, CURLOPT_POST, true);
//		curl_setopt($ch, CURLOPT_POSTFIELDS, $message);
//		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//		curl_exec($ch);
//		curl_close($ch);
//
//		echo $output;
//		return 1;

		$user = User::pick(1);
		try {
			User::search(\Atomino\Carbon\Database\Finder\Filter::where("a=1"))->pick();
		} catch (\Exception $e) {

		}

		debug("Hello\nHello");
		debug(1);
		debug(1.1);
		debug(true);
		debug(false);
		debug(null);
		debug(['a', 'b' => $user, 'c']);
		return 1;
	}

}