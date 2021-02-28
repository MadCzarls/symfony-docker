Repo for project template running on docker with nginx 1.19, + PHP 8.0 + MySQL 8.0.
By default, should be available under `http://localhost:8050/`.

#Requirements

1. Docker version 20.10.3, build 48d30b5
1. docker-compose version 1.28.4, build cabd5cfb

#TODO
1. sniffer php-cs

#Overview
All php extensions can be installed via `docker-php-ext-install` command. Examples:
`https://gist.github.com/giansalex/2776a4206666d940d014792ab4700d80`.

To enable xdebug:
1. In PhpStorm: Settings -> Languages & Frameworks -> PHP -> Debug: Xdebug -> Debug port: 9003 (set by default) and check 'Can accept external connections'.
1. In PhpStorm: Settings -> Languages & Frameworks -> PHP -> Servers: create server with name 'docker' (the same as in ENV variable PHP_IDE_CONFIG), host 'localhost', port '8050' (default from docker-compose.yml.dist).
1. Add path mappings to File directory <-> Absolute path on server as: `</absolute/path/symfony-docker/app` <-> `/var/www/app` 
   (default from docker-compose.yml.dist).
1. In PhpStorm: Start Listening for PHP Debug connections.

#Final notes
Although there are present different files for `prod` and `dev` environments these are only stubs and this repo is designed
to be much integral, self-contained and flexible as possible. Ideally you should end up with different docker-compose and
Dockerfiles for `prod` and `dev` environments.
If you really want to use it on production just remember:
1. Change your ENV files nad variables loaded in docker-compose.
1. Review all arguments passed in docker-compose.
1. Review all directories ownership and permissions.
1. Don't deploy dir `scripts/` on your production server.