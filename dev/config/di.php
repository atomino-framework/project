<?php return array_merge(...array_map(fn($file) => include $file, glob(__DIR__ . "/di/*.php")));
