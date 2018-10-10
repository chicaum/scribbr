# Scribbr

Weather prediction application

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

As the application runs in a docker container, these should be installed:

```
Composer
Docker
Docker-machine (MacOS, Windows)
Git
```

### Installing

Clone the project


```
git clone https://github.com/chicaum/scribbr.git
```

Change into project dir

```
cd scribbr
```

Install the dependencies

```
composer install
```

Start the container
```
docker-compose up -d
```

##Prepare the database
Execute a 'docker ps' command and get the fpm container ID
```
CONTAINER ID        IMAGE                                   COMMAND                  CREATED             STATUS              PORTS                               NAMES
4e34abb66618        scribbr_fpm                             "docker-php-entrypoi…"   6 minutes ago       Up 6 minutes        9000/tcp                            scribbr_fpm_1
25f71e8be24a        scribbr_nginx                           "nginx -g 'daemon of…"   6 minutes ago       Up 6 minutes        0.0.0.0:8011->80/tcp                scribbr_nginx_1
b9eac2e09f06        mysql:5.6                               "docker-entrypoint.s…"   About an hour ago   Up 6 minutes        0.0.0.0:3311->3306/tcp              scribbr_db_1
```

Access the fpm container 'docker exec -it <CONTAINER-ID>' bash
Execute the migrations command
```
php bin/console doctrine:migrations:migrate --no-interaction
```

## Access the application

```
http://localhost:8011
```

## Database access - MySQL 5.6

```
user: root
pass: root
port: 3311
```
 
## Running the tests

Todo

## Built With

* [Docker](https://www.docker.com/) - Docker - Build, Ship, and Run Any App, Anywhere
* [Symfony](https://symfony.com/) - Symfony, High Performance PHP Framework for Web Development
* [Composer](https://getcomposer.org/) - Dependency Management

## Authors

* **Ademir Francisco da Silva** - *Initial work* - [Ademir Silva](https://github.com/chicaum)