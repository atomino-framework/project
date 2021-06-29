<?php

$projectRoot = realpath(__DIR__.'/..');
mkdir($projectRoot.'/.my-repos');

// copy / create base files

copy($projectRoot . '/assets/atomino.ini', $projectRoot . '/atomino.ini');
unlink($projectRoot . '/.gitignore');
rename($projectRoot . '/install/.gitignore.dist', $projectRoot . '/.gitignore');

// modify the composer.json

$composer = json_decode(file_get_contents($projectRoot . '/composer.json'), true);
$composer['authors'] = [];
unset($composer['description']);
unset($composer['repositories']);
$composer['name'] = basename($projectRoot).'/project';
file_put_contents($projectRoot . '/composer.json', json_encode($composer, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

// remove installer

unlink($projectRoot . '/install/post-install-script.php');
