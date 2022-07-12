<?php

if(!isset($argv[1])) $argv[1] = 'vhost';

$root = realpath(__DIR__ . "/../..");
$source = "$root/etc/".$argv[1];
$target = "$root/var/vhost";

$domain = getenv("DOMAIN");

if(!is_dir($target)) mkdir($target);
foreach (glob($source.'/*') as $file){
	$file = pathinfo($file, PATHINFO_BASENAME);
	copy($source.'/'.$file, $target.'/'.$file);
}

$template = file_get_contents($target.'/vhost.conf');
$template = str_replace('{{domain}}', $domain, $template);
$template = str_replace('{{root}}', realpath(__DIR__.'/..'), $template);
file_put_contents($target.'/vhost.conf', $template);

echo 'DONE'."\n";
