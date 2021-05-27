<?php
include getenv("@root")."/vendor/autoload.php";
new Atomino\Core\Application(include getenv('@config'), include getenv('@di'));
