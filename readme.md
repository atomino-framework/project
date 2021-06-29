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
- `bin/atomino mig:init` - initializes the migrations
- `bin/atomino mig:migrate` - do the first migration (users)
- `bin/atomino publish` - copy all assets to the public folder

## Test CLI

- run `bin/atomino` in terminal

## Run and test with the built-in server

- run the development server:
  `php -S 127.0.0.1:8080 bin/dev.php`
- open in browser: `http://my-project.localhost:8080`
  - you should see an atom
- open in browser: `http://api.my-project.localhost:8080/user/1`
  - you should see a json
- run the logger server:  
  `php -qS 127.0.0.1:8083 bin/log.php`

# Setup apache
- open `var/vhost/vhost.conf` and set the `domain`, and `root` variables
- include the `var/vhost/vhost.conf` in your `httpd.conf` or `apache2.conf` file
- reload/restart apache
- open the `http://my-project.localhost` you just set in your browser

## HTTPS

There is a built-in solution for https, but you can setup your vhost as you like.
