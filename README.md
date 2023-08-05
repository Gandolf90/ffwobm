# docker-cake
template for docker-cakephp

initial to install : 

in app folder : 

composer install 

in app/configs -> .env create
in app/configs -> app_local.php create ( with container name for DB!)
in /etc/hosts -> 0.0.0.0 mysql
in docker -> .env create

# Migrations

to migrate :

bin/cake migrations migrate 

to create new :

bin/cake migrations create Name 