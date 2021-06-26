<?php namespace Application\Modules;


use Application\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use function Atomino\debug;


class Test extends Command {

	public function __construct() {
		parent::__construct("test");
	}

	protected function execute(InputInterface $input, OutputInterface $output) {

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