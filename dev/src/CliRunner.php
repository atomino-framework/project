<?php namespace Application;

use Atomino\Carbon\Database\Cli\Migrator;
use Atomino\Carbon\Cli\Entity;
use Atomino\Core\Publish;
use Atomino\Magic\Cli\Magic;
use function Atomino\dic;

class CliRunner extends \Atomino\Cli\CliRunner {
	function setup() {
		Migrator::addToRunner($this, dic()->get("migration-config"));
		Entity::addToRunner($this, dic()->get("entity-generator"));
		Magic::addToRunner($this, dic()->get("magic"));
		Publish::addToRunner($this);
	}
}
