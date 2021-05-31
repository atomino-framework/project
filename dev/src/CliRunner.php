<?php namespace Application;

use Application\Entity\User;
use Atomino\Carbon\Database\Cli\Migrator;
use Atomino\Carbon\Cli\Entity;
use Atomino\Carbon\Database\Finder\Filter;
use Atomino\Cli\Attributes\Command;
use Atomino\Cli\CliCommand;
use Atomino\Cli\CliModule;
use Atomino\Core\ConfigCache;
use Atomino\Core\Publish;
use Atomino\Magic\Cli\Magic;
use Symfony\Component\HttpFoundation\Request;
use function Atomino\cfg;
use function Atomino\debug;
use function Atomino\dic;

class CliRunner extends \Atomino\Cli\CliRunner {
	function setup() {
		Migrator::addToRunner($this, dic()->get("migration-config"));
		Entity::addToRunner($this, dic()->get("entity-generator"));
		Magic::addToRunner($this, dic()->get("magic"));
		Publish::addToRunner($this);
		ConfigCache::addToRunner($this);
		Test::addToRunner($this);
	}
}


class Test extends CliModule {
	#[Command('test')]
	public function entity(): CliCommand {
		return (new class() extends CliCommand {
			protected function exec(mixed $config) {
				debug('hello');
				$user = User::pick(1);
				debug($user);
				$user->ee();
				$user = User::search(Filter::where('aaa=1'))->pick();
				debug(User::pick(1));

			}
		});
	}
}