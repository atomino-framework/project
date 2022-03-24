# Installation

## Requirements

- php 8.0;
- ext-gd
- ext-curl
- ext-mbstring
- php-mysql
- mysql 8.0
- composer 2

### Optional  

- node 15.14.0
- npm 7.7.6  
- apache 2.4

## Create project

- `composer create-project atomino/project your-project -s dev`
- Configure your project within the installer
- Create a `mysql` database for your project (utf-8)
- `bin/mkvardir.sh` - creates the `var` directory structure
- give permissions to the webserver to write the whole `var` directory  
- `bin/atomino mig:init` - initializes the migrations
- `bin/atomino mig:migrate` - do the first migration (users)
- `bin/publish.sh` - copy all files from `etc/public` to the `var/public` folder

## Frontend

This project uses svelte as frontend framework. Frontend project can be found in the `frontend` folder.
These are separate projects - each of those has it's own root folder - embedded into your application.

- You should install the dependencies:
  - `cd frontend/admin`
  - `npm install`
- Build your code
  - `npm run dev` - development build with watch, compiles directly into the `var/public` folder
  - or `npm run build` - production build, it compiles into the `etc/public` folder
    - to make it work you need to publish is to `var/public`

## Fonts

(npm required)

There is a built-in solution for `fontawesome` and all `@fontsource` fonts to handle.

- `cd frontend/admin` (or any other frontend directory)
- `npm run fonts` - this copies all `@fontsource` and `fontawesome` (pro/free)  from `node_moduels` to `etc/public`
- `bin/publish.sh`

## Run and test with the built-in server

- Run the logger server: `bin/log.sh`
- Run the development server: `bin/dev.sh`
- Open website in browser: `http://my-project.localhost:8080`
  - You should see an atom
- Open gold admin in the browser: `http://admin.my-project.localhost:8080`  
  - user: `atomino@atomino.atom`
  - pass: `atomino`
- Test the api in a browser: `http://api.my-project.localhost:8080/user/1`
  - You should see a json
  - Try it with the [Chrome Json Formatter extension](https://chrome.google.com/webstore/detail/json-formatter/bcjindcccaagfpapjjmafapmmgkkhgoa)

## Setup apache
- Run `bin/vhost`,
  - It copies `etc/vhost` folder to `var/vhost`
  - and Updates the `root` and `domain` variables in the `vhost.conf` file based on the `atomino.ini`
- Include the `var/vhost/vhost.conf` in your `httpd.conf` or `apache2.conf` file
- Reload / restart apache
- Open the `http://my-project.localhost` in your browser
- There is a built-in solution for https, but you can setup your vhost as you like.
