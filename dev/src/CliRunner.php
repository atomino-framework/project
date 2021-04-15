<?php namespace Application;

use Atomino\Core\Application;
use Atomino\Database\Cli\Migrator;
use Atomino\Entity\Cli\Entity;
use function Atomino\dic;

class CliRunner extends \Atomino\Cli\CliRunner{
	function setup(){
		Migrator::addToRunner($this, dic()->get("migration-config"));
		Entity::addToRunner($this, dic()->get("entity-generator"));
	}
}