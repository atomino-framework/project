# Installation

## Requirements

- php 8.0; gd
- apache 2.0
- mysql 8.0
- composer

## Create project

- `composer create-project atomino/project your-project -s dev`
- `cd your-project`
- `mv atomino.ini.dist atomino.ini`
- create a mysql database for your project (utf-8)
- open `atomino.ini` with a text editor and set all the config values
  - database connection
  - your applications domain (eg: my-project.localhost)
  - secret for image creator
  - secret for jwt token generator
- `./atomino mig:init` - initializes the migrations
- `./atomino mig:migrate` - do the first migration (users)
- `./atomino publish` - copy all assets to the public folder

## Run and test with the built-in server

- `php -S 127.0.0.1:8080 atomino`
- open in browser: `http://www.my-project.localhost:8080`
  - you should see an atom
- open in browser: `http://api.my-project.localhost:8080/user/1`
  - you should see a json

# Setup apache

- `mv app/etc/vhost.dist app/etc/vhost`
- open `app/etc/vhost/vhost.conf` and set the domain, and root variables
- include the `app/etc/vhost/vhost.conf` in your httpd.conf file
- reload/restart apache
- open the `http://www.my-project.localhost` you just set in your browser

## HTTPS

There is a built-in solution for https, but you can setup your vhost as you like.

# Setup node environment

## Requirements

- npm 7.7.6
- node 15.14.0

## Install

- `npm install`
- `npm run fontawesome` - copies the fontawesome to assets
- `npm run fonts` - copies other @fontsource fonts to assets
- `npm run build` - builds the frontend packages
- `npm run assets` or `./atomino publish` - copies all assets to public
- open the `http://admin.my-project.localhost` in your browser
  - user: atomino@atomino.atom
  - pass: atomino
