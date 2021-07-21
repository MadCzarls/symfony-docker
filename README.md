# Description

Symfony 5 project template running on Docker (utilizing docker-compose) with PHP 8.0 + nginx 1.18 + PostgreSQL 11. By default includes xdebug extension and PHP_CodeSniffer for easy development and basic configuration for opcache for production. Includes instruction for setting it in PhpStorm.

- https://symfony.com/
- https://www.docker.com/
- https://docs.docker.com/compose/
- https://www.php.net/
- https://www.nginx.com/
- https://www.postgresql.org/
- https://xdebug.org/
- https://github.com/squizlabs/PHP_CodeSniffer
- https://www.php.net/manual/en/intro.opcache.php
- https://www.jetbrains.com/phpstorm/

Clone and tweak it to your needs. Tested on Linux (Ubuntu 20.04):

1. Docker version 20.10.7, build f0df350
1. docker-compose version 1.29.2, build 5becea4c

and Windows 10:

1. Use `Docker for Windows`, at least version `3.2.1`.
1. Switch to `Linux containers`.
1. Go to `Settings` -> `Docker Engine` and set `experimental mode` to `true`.

# Usage

Clone repository, `cd` inside, create `docker-compose.yml` based on `docker-compose.yml.dist` with `cp docker-compose.yml.dist docker-compose.yml` command. If needed, change configuration according to the comments inside. Then define your `APP_SECRET` in the correct file based on your ENV (`docker/php/.env.app.[dev/prod]`). You can change PHP memory limit in `docker/php/config/docker-php-memlimit.init` file if you want. Afterwards run:

<pre>
docker-compose build
docker-compose up
</pre>

After that log into container with `docker exec -it app.php bash`, where `app.php` is the default container name from `docker-compose.yml.dist`. Then run:

<pre>
composer install
</pre>

From this point forward, application should be available under `http://localhost:8050/`, where port `8050` is default defined in `docker-compose.yml.dist`.

### Running tests

Environment variable `APP_ENV` must be set to `test` to be able to run Kernel-/Web-TestCases based tests because
`Real environment variables win over .env files` and this is the case in docker-based environments.

### Specific case concerning test-driven development :

Solution implemented in https://symfony.com/blog/new-in-symfony-4-1-simpler-service-testing lets you test
only services which are used in application, eg. injected in controller - otherwise they will be removed from container,
even in `test` environment. To overcome this and be able to test services not-yet used file `config/services_test.yaml`
should be created. But the disadvantage of this is that all services' definitions from `config/services.yaml` must be
duplicated to `services_test.yaml` as well but including setting `_defaults.public` config to `true`.

# Overview

All PHP extensions can be installed via `docker-php-ext-install` command in docker/php/Dockerfile. Examples and usage:
`https://gist.github.com/giansalex/2776a4206666d940d014792ab4700d80`.

## PhpStorm configuration
_Based on PhpStorm version: 2021.1.4_

Open directory including cloned repository as directory in PhpStorm.

### Interpreter

1. `Settings` -> `PHP` -> `Servers`: create server with name `docker` (the same as in ENV variable `PHP_IDE_CONFIG`), host `localhost`, port `8050` (default from `docker-compose.yml.dist`).
1. Tick `Use path mappings` -> set `File/Directory` <-> `Absolute path on the server` as: `</absolute/path>/symfony-docker/app` <-> `/var/www/app` (default from docker-compose.yml.dist).
1. `Settings` -> `PHP`: three dots next to the field `CLI interpreter` -> `+` button -> `From Docker, Vagrant(...)` -> from `docker-compose`, from service `php`, server `Docker`, configuration files `./docker-compose`. After creating in `Lifecycle` section ensure to pick `Always start a new container (...)`, in `General` refresh interpreter data.

### xdebug

1. `Settings` -> `PHP` -> `Debug`  -> `Xdebug` -> `Debug port`: `9003` (set by default) and check `Can accept external connections`.
1. Click `Start Listening for PHP Debug connections` -> `+` button, set breakpoints and refresh website.

### PHPCS

1. Copy `app/phpcs.xml.dist` and name it `phpcs.xml`. Tweak it to your needs.
1. `Settings` -> `PHP` -> `Quality Tools` -> `PHP_CodeSniffer` -> `Configuration`: three dots, add interpreter with `+` and validate paths. By default, there should be correct path mappings and paths already set to `/var/www/app/vendor/bin/phpcs` and `/var/www/app/vendor/bin/phpcbf`.
1. `Settings` -> `Editor` -> `Inspections` -> `PHP` -> `Quality tools` -> tick `PHP_CodeSniffer validation` -> tick `Show sniff name` -> set coding standard to `Custom` -> three dots and type `/var/www/app/phpcs.xml` (path in container).

### PostgreSQL

Open `Database` section on the right bar of IDE -> `Data Source` -> `PostgreSQL` -> set host to `localhost`, set user to `app_user`, pass `app_pass`, database to `app` (defaults from docker-compose.yml.dist) Set url to `jdbc:postgresql://localhost:5432/app`.

### PHPUnit

1. Copy `phpunit.xml.dist` into `phpunit.xml`.
1. Login into `app.php` container where `app.php` is the default container name from `docker-compose.yml.dist`, and run `./bin/phpunit`.
1. `Settings` -> `PHP` -> `Test frameworks`. Click `+` and `PHPUnit by Remote Intepreter` -> pick interpreter. In `PHPUnit library` tick `Path to phpunit.phar` and type `bin/phpunit`. Click refresh icon. In `Test runner` section set `Default configuration file` to `phpunit.xml` and `Default bootstrap file` to `tests/bootstrap.php`.

# Disclaimer

Although there are present different files for `prod` and `dev` environments these are only stubs and this repo is not suitable to run on `prod` environment. The idea was to create as much integral, self-contained and flexible environment for `development` as possible and these files are here merely to easily mimic `prod` env and point out differences in configuration.