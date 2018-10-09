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
## Access the application

```
localhost:8011
```

## Database - MySQL 5.6

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