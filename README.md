# Description
Symfony 5 project template running on Docker (utilizing docker-compose) with PHP 8.0 + nginx 1.19 + MySQL 8.0. By default includes xdebug extension and PHP_CodeSniffer for easy development and basic configuration for opcache for production. Includes instruction for setting it in PhpStorm.

* https://symfony.com/
* https://www.docker.com/
* https://docs.docker.com/compose/
* https://www.php.net/
* https://www.nginx.com/
* https://www.mysql.com/
* https://xdebug.org/
* https://github.com/squizlabs/PHP_CodeSniffer
* https://www.php.net/manual/en/intro.opcache.php
* https://www.jetbrains.com/phpstorm/

Clone and tweak it to your needs. Tested on:
1. Docker version 20.10.3, build 48d30b5
1. docker-compose version 1.28.4, build cabd5cfb

# TODO
1. scripts - move container name to ENV and used this name in scripts

# Usage
Clone repository, `cd` inside, create `docker-compose.yml` based on `docker-compose.yml.dist` (take into account comments inside) and run:
<pre>
docker-compose build
docker-compose up
</pre>

Then login into container with script `scripts/login_php` and run:
<pre>
composer install
</pre>

By default, application should be available under `http://localhost:8050/`.

#Overview
All PHP extensions can be installed via `docker-php-ext-install` command in docker/php/Dockerfile. Examples and usage:
`https://gist.github.com/giansalex/2776a4206666d940d014792ab4700d80`.

## PhpStorm configuration
Open directory including cloned repository as directory in PhpStorm.

### Interpreter
1. `Settings` -> `Languages & Frameworks` -> `PHP` -> `Servers`: create server with name `docker` (the same as in ENV variable `PHP_IDE_CONFIG`), host `localhost`, port `8050` (default from docker-compose.yml.dist).
1. Tick `Use path mappings` ->  to `File directory` <-> Absolute path on server as: `</absolute/path/symfony-docker/app` <-> `/var/www/app` (default from docker-compose.yml.dist).
1. `Settings` -> `Languages & Frameworks` -> `PHP`: three dots next to the field `CLI interpreter` -> `+` button -> `From DOcker, Vagrant(...)` -> from `docker-compose`, from service `php`, server `Docker`, configuration files `./docker-compose`. After creating in `Lifecycle` section ensure to pick `Always start a new container (...)`, in `General` refresh interpreter data.

### xdebug
1. `Settings` -> `Languages & Frameworks` -> `PHP` -> `Debug: Xdebug` -> `Debug port`: `9003` (set by default) and check `Can accept external connections`.
1. Click `Start Listening for PHP Debug connections` -> `+` button, set breakpoints and refresh website.

### PHPCS
1. `Settings` -> `Languages & Frameworks` -> `PHP` -> `Quality Tools` -> `PHP_CodeSniffer` -> `Configuration`: three dots, pick interpreter and validate paths. By default, there should be correct path mappings and paths already set to `/var/www/app/vendor/bin/phpcs` and `/var/www/app/vendor/bin/phpcbf`.
1. `Settings` -> `Editor` -> `Inspections` -> `PHP` -> `Quality tools` -> `PHP_CodeSniffer validation` -> tick `Show sniff name` -> pick coding standard to `Custom` -> three dots and type `/var/www/app/phpcs.xml`.
1. Tweak app/phpcs.xml to your needs.

### MySQL
Open `Database` section on the right bar of IDE -> `Data Source` -> `MySQL` -> set host to `localhost`, port to `33306`, user to `app_user`, pass `app_pass` (defaults from docker-compose.yml.dist).

# Disclaimer
Although there are present different files for `prod` and `dev` environments these are only stubs and this repo is not suitable to run on `prod` environment. The idea was to create as much integral, self-contained and flexible environment for `development` as possible and these files are here to easily mimic `prod` env and point out differences in configuration.