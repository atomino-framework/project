DOMAIN=`php -r 'echo parse_ini_file("atomino.ini")["domain"];'`
PORT=${1-8080}
echo "listening: http://${DOMAIN}:${PORT}"
php -qS 127.0.0.1:$PORT bin/http-dev.php
