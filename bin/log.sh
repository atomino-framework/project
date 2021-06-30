PORT=`php -r 'echo parse_ini_file("atomino.ini")["debug.port"];'`
php -qS 127.0.0.1:${1-$PORT} bin/http-log.php
