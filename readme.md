#Atomino

## Environment

- php 8.0
  - php gd
- apache 2.0
- mysql 5.6
- npm 7.7.6
- node 15.14.0
- composer

## Installation

- `composer create-project atomino/project your-project -s dev`
- `cd your-project`
- `npm install`
- `mv atomino.ini.dist atomino.ini`
- create a mysql database for your project (utf-8)
- open `atomino.ini` with a text editor and set all the config values
- `./atomino mig:init`
- `./atomino mig:migrate`

## Run the built in server

- `npm run serve`
- open in browser: `www.myproject.localhost:8080`
  - you should see an atom
- open in browser: `api.myproject.localhost:8080/user/1`
  - you should see a json

## Setup apache

- `mv app/etc/vhost.dist app/etc/vhost`
- open `app/etc/vhost/vhost.conf` and set the domain, and root variables
- include the `app/etc/vhost/vhost.conf` in your httpd.conf file
- reload/restart apache
- open the domain you just set in your browser