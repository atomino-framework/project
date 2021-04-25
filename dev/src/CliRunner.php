<?php namespace Application;

use Atomino\Core\Application;
use Atomino\Database\Cli\Migrator;
use Atomino\Entity\Cli\Entity;
use Symfony\Component\HttpFoundation\Request;
use function Atomino\dic;

class CliRunner extends \Atomino\Cli\CliRunner{
	function setup(){
		var_dump(dic()->get(Request::class));
		Migrator::addToRunner($this, dic()->get("migration-config"));
		Entity::addToRunner($this, dic()->get("entity-generator"));
	}
}