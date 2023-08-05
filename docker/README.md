# cakephp-docker
A Docker Compose setup for containerized CakePHP Applications

This setup spools up the following containers

* **mysql** (8.0.19)
* **nginx**
* **php-fpm** (php 7.4)
* **mailhog** (smtp server for testing)
* **adminer** (4.7.5)
* **redis** (current version)

The guide will walk you thru the following things

* [Installation](#installation)
* [Installing Docker on my Host](#installing-docker-on-my-host)

## Installation

clone this repo to your host
cd in repo folder
cd in docker folder 

Next, **Update the Environment File**

Copy or Rename `docker/.env.sample` to `docker/.env`.
This is an environment file that your Docker Compose setup will look for automatically which gives us a great, simple way to store things like your mysql database credentials outside of the repo.

By default the file will contain the following

```
MYSQL_ROOT_PASSWORD=root
MYSQL_DATABASE=atea_db
MYSQL_USER=atea
MYSQL_PASSWORD=atea
REDIS_PASS=redis
```
Docker Compose will automatically replace things like `${MYSQL_USER}` in the `docker-compose.yml` file with whatever corresponding variables it finds defined in `.env`

Lastly, **Find/Replace** `myapp` with the name of your app.

> **WHY?** by default the files are set to name the containers based on your app prefix. By default this is `myapp`.
> A find/replace on `myapp` is safe and will allow you to customize the names of the containers
> 
> e.g. myapp-mysql, myapp-php-fpm, myapp-nginx, myapp-mailhog

**Build and Run your Containers**

```bash
cd /path/to/your/app/docker
docker-compose -up
```

That's it. You can now access your CakePHP app at 

`localhost:8888`

> **tip**: start docker-compose with `-d` to run (or re-run changed containers) in the background.
> 
> `docker-compose up -d`

**Connecting to your database**

Also by default the first time you run the app it will create a `MySQL` database with the credentials you specified in your `.env` file (see above)

``` yaml
host : myapp-mysql
username : myapp
password : myapp
database : myapp
```

You can access your MySQL database (with your favorite GUI app) on 

`localhost:8080`

Your `app/config.php` file should be set to the following (it connects through the docker link)

```php
  'Datasources' => [
    'default' => [
      'host' => 'myapp-mysql',
      'port' => '3306',
      'username' => 'myapp',
      'password' => 'myapp',
      'database' => 'myapp',
    ],
```

To change these defaults edit the variables in the `docker/.env` file or tweak the `docker-compose.yml` file under `myapp-mysql`'s `environment` section.

## Now, how to run `bin/cake` and `mysql`

Now that you're running stuff in containers you need to access the code a little differently

You can run things like `composer` on your host, but if you want to run `bin/cake` or use MySQL from commandline you just need to connect into the appropriate container first

**access your php server**

```bash
docker exec -it php-fpm /bin/bash
```

**access mysql cli**

```bash
docker exec -it mysql /usr/bin/mysql -u root -p myapp
```
> remember to replace `myapp` with whatever you really named the container and with your actual database name and user login

### `myapp-mailhog` - the smtp server

This is just a built-in mail server you can use to 'send' and intercept mail coming from your application.

Set up your `app/config.php` with the following

```php
    'EmailTransport' => [
        ...
	    'mailhog' => [
	        # These are default settings for the MailHog container - make sure it's running first
	        'className' => 'Smtp',
	        'host' => 'myapp-mailhog',
	        'port' => 1025,
	        'timeout' => 30,
	      ],
	      ...
```          

You can access the **Web GUI** (using the defaults) for mailhog at

`localhost:8125`

To send mail over the transport layer just set your `Email::transport('mailhog')`


## Installing Docker on my Host

If you've never worked with Docker before they have some super easy ways to install the needed runtimes on almost any host

* Mac, Windows, Ubuntu, Centos, Debian, Fedora, Azure, AWS

You can download the (free) community edition here [https://www.docker.com/community-edition#/download]()

**Cloud Hosting Docker Applications** 

[DigitalOcean](https://m.do.co/c/640e75c994b4) has been super reliable for us as a host and has a one-click deploy of a  docker host.

Just click `CREATE DROPLET` and then under `Choose an Image` pick the `One-click Apps` (tab) and choose `Docker X.Y.Z on X.Y` and you're good to go; DO will spool up a droplet with `docker` and `docker-compose` already installed and ready to run.

## Install php on host

to use php local on host ( mac ) 
install brew
brew install php@7.4
brew link php@7.4
pecl install redis

brew install python
ls -l /usr/local/bin/python*
ln -s -f /usr/local/bin/python3 /usr/local/bin/python
( check version -> which python -> should /usr/local/bin/python )
python --version

## Troubleshooting

**nginx open logs/access.log failed no such file or directory**


`myapp-nginx | nginx: [emerg] open() "/var/www/myapp/logs/access.log" failed (2: No such file or directory)`

This is caused by not installing CakePHP completely and can be fixed by creating the logs folder in your `myapp/cakephp` folder.


## To Speed up!
add in `/etc/hosts` `127.0.0.1 localunixsocket.localdomain` `127.0.0.1 localunixsocket`

## Migrations
https://mixable.blog/cakephp-3-kurzfassung-zum-verwenden-von-migrations/
https://devarticles.in/everything-you-need-to-know-about-cakephp-migrations/
https://www.bookstack.cn/read/cakephp-4.x/5bc3bef3b2881700.md