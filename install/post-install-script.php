<?php

$projectRoot = realpath(__DIR__.'/..');

function struct($tree, $root) {
	$root = rtrim($root, '/') . '/';
	foreach ($tree as $name => $value) {
		if (is_array($value)) {
			mkdir($root . $name, 0777, true);
			struct($value, $root . $name);
		} else {
			touch($root . $value);
		}
	}
}

// create needed folders

struct([
	'.my-repos'=>[],
	'app' => [
		'data'   => [
			'attachments' => ['.gitkeep'],
		],
		'etc'    => ['.gitkeep'],
		'public' => ['.gitkeep'],
		'tmp'    => ['.gitkeep'],
		'var'    => [
			'log' => ['.gitkeep'],
		],
	],
], $projectRoot);

// copy / create base files

rename($projectRoot . '/install/atomino.ini', $projectRoot . '/atomino.ini');
rename($projectRoot . '/install/vhost', $projectRoot . '/app/etc/vhost');
unlink($projectRoot . '/.gitignore');
rename($projectRoot . '/install/.gitignore.dist', $projectRoot . '/.gitignore');
file_put_contents($projectRoot . '/app/var/version', '1');

// modify the composer.json

$composer = json_decode(file_get_contents($projectRoot . '/composer.json'), true);
$composer['authors'] = [];
unset($composer['description']);
unset($composer['repositories']);
$composer['name'] = basename($projectRoot);
file_put_contents($projectRoot . '/composer.json', json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// modify the package.json

$package = json_decode(file_get_contents($projectRoot . '/package.json'), true);
$package['author'] = '';
$package['name'] = basename($projectRoot);
file_put_contents($projectRoot . '/package.json', json_encode($package, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// remove installer

unlink($projectRoot . '/install/post-install-script.php');
