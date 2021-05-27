<?php
use function Atomino\{loadenv, path};
include __DIR__ . "/../vendor/autoload.php";
putenv("@root=" . realpath(__DIR__ . '/../'));
loadenv(path('atomino.env'));
new Atomino\Core\Application(include getenv('@config'), include getenv('@di'));
