<?php use Atomino\Core\Application;

require getenv("@root")."/vendor/autoload.php";

Application::setConfig(include getenv('@config'));
Application::setDI(include getenv('@di'));
Application::boot();
