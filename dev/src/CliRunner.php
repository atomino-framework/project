<?php namespace Application;

use Application\Entity\Article;
use Application\Entity\User;
use Application\Modules\CommentView;
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
				$article->addComment(User::pick(2),'Lofasztalicska',4);
				$comments = $article->getComments(User::pick(1),1,100);
				$converter = $article->getConverter(User::pick(1),CommentView::class, User::class, true);
				print_r( $converter->convertComments($comments) );
			}
		});
	}
}