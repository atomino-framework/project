<?php namespace Application;

use Atomino\Carbon\Cli\Entity;
use Atomino\Carbon\Database\Cli\Migrator;
use Atomino\Cli\Attributes\Command;
use Atomino\Cli\CliCommand;
use Atomino\Cli\CliModule;
use Atomino\Core\ConfigCache;
use Atomino\Core\Publish;
use Atomino\Magic\Cli\Magic;
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
				$this->style->comment('Hello Atomino');
			}
		});
	}
}