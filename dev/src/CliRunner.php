<?php namespace Application;

use Application\Entity\Article;
use Application\Entity\User;
use Atomino\Cli\Attributes\Command;
use Atomino\Cli\CliCommand;
use Atomino\Cli\CliModule;
use Atomino\Database\Cli\Migrator;
use Atomino\Entity\Cli\Entity;
use Atomino\Molecules\Magic\Cli\Magic;
use function Atomino\dic;

class CliRunner extends \Atomino\Cli\CliRunner {
	function setup() {
		Migrator::addToRunner($this, dic()->get("migration-config"));
		Entity::addToRunner($this, dic()->get("entity-generator"));
		Magic::addToRunner($this, dic()->get("magic"));
		Test::addToRunner($this);
	}
}

class Test extends CliModule {

	#[Command('test')]
	public function test(): CliCommand {
		return (new class() extends CliCommand {
			protected function exec(mixed $config) {
				$article = Article::pick(2);
				print_r($article->isCommentModerator()?1:0);
				$article->addComment('Hello');
			}
		});
	}
}