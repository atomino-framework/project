<?php
$projectRoot = realpath(__DIR__ . '/..');
system("stty -icanon");
echo "Do you want to configure your application? (y/n) ";
$c = fread(STDIN, 1);

if (strtolower($c) === 'y') {

	echo "\n";

	echo "application name (" . basename($projectRoot) . "): ";
	$appName = readline();
	$appName = $appName ?: basename($projectRoot);

	echo "domain name (" . $appName . '.localhost' . "): ";
	$domain = readline();
	$domain = $domain ?: $appName . '.localhost';

	echo "database host (" . 'localhost' . "): ";
	$databaseHost = readline();
	$databaseHost = $databaseHost ?: 'localhost';

	echo "database (" . $appName . "): ";
	$database = readline();
	$database = $database ?: $appName;

	echo "database user (" . $appName . "): ";
	$databaseUser = readline();
	$databaseUser = $databaseUser ?: $appName;

	echo "database password (empty): ";
	$databasePassword = readline();

	$translate = [
		"{{root}}" => $projectRoot,
		"{{domain}}"=>$domain,
		"{{database}}"=>$database,
		"{{databaseHost}}"=>$databaseHost,
		"{{databaseUser}}"=>$databaseUser,
		"{{databasePassword}}"=>$databasePassword,
		"{{jwtSecret}}"=>uniqid(),
		"{{imgSecret}}"=>uniqid(),
		"{{appid}}"=>uniqid(),
	];

	$ini = file_get_contents($projectRoot.'/install/.env.template');
	$ini = strtr($ini, $translate);
	file_put_contents($projectRoot.'/etc/.env', $ini);

	echo "\ndone\n";
}
unlink($projectRoot.'/install/.env.template');
unlink($projectRoot . '/install/post-install-finish-script.php');
rmdir($projectRoot . '/install');
rmdir($projectRoot . '/.my-repos');
