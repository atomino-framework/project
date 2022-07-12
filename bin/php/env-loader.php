<?php
$root = realpath(__DIR__ . "/../..");
require "$root/vendor/autoload.php";
$env = new Symfony\Component\Dotenv\Dotenv();
echo $env->parse(file_get_contents("$root/etc/.env"))[$argv[1]];