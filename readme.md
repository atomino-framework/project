# Installation

## Requirements

- php 8.0; gd
- apache 2.4
- mysql 8.0
- composer

## Create project

- `composer create-project atomino/project your-project -s dev`
- Configurate your project within the installer
- create a mysql database for your project (utf-8)
- `bin/mkvardir.sh` - creates the `var` directory structure
- `bin/atomino mig:init` - initializes the migrations
- `bin/atomino mig:migrate` - do the first migration (users)
- `bin/publish.sh` - copy all assets to the public folder

## Run and test with the built-in server

- run the development server:
  `php -S 127.0.0.1:8080 bin/http-dev.php` or `bin/dev.sh`
- open in browser: `http://my-project.localhost:8080`
  - you should see an atom
- open magic in browser: `http://admin.my-project.localhost:8080`  
  - user: `atomino@atomino.atom`
  - pass: `atomino`
- open in browser: `http://api.my-project.localhost:8080/user/1`
  - you should see a json
- run the logger server: `php -qS 127.0.0.1:8083 bin/http-log.php` or `bin/log.sh`

## Setup apache
- copy `assets/vhost` to `var`
- open `var/vhost/vhost.conf` and set the `domain`, and `root` variables
- include the `var/vhost/vhost.conf` in your `httpd.conf` or `apache2.conf` file
- reload/restart apache
- open the `http://my-project.localhost` in your browser
- there is a built-in solution for https, but you can setup your vhost as you like.
