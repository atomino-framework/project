<?php namespace Application\Missions\Cli;

use Atomino\Core\ApplicationConfig;
use Atomino\Core\Cli\Attributes\Command;
use Atomino\Core\Cli\CliCommand;
use Atomino\Core\Cli\CliModule;
use Atomino\Core\Cli\CliTree;
use Atomino\Core\Cli\Style;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\Console\Output\Output;

class Common extends CliModule {
	public function __construct(private ApplicationConfig $config) { }

	#[Command("show-config", "cfg", "Shows the config")]
	public function showConfig(CliCommand $command) {
		$command->define(function (Input $input, Output $output, Style $style) {
			echo CliTree::draw($this->config->all(), 'cfg');
		});
	}
}
