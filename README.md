Technical Test generated environment
==================================

# How to run #

Dependencies:

* docker. See [https://docs.docker.com/engine/installation](https://docs.docker.com/engine/installation)
* docker-compose. See [docs.docker.com/compose/install](https://docs.docker.com/compose/install/)

Once you're done, simply `cd` to the project and run `docker-compose up -d`. This will initialise and start all the
containers, then leave them running in the background.

## Services exposed outside your environment ##

You can access your application via **`localhost`**. Mailhog and nginx both respond to any hostname, in case you want to
add your own hostname on your `/etc/hosts`

Service|Address outside containers
-------|--------------------------
Webserver|[localhost:64000](http://localhost:64000)
MySQL|**host:** `localhost`; **port:** `64002`
PhpMyAdmin|**host:** `localhost`; **port:** `64001`

# Docker compose cheatsheet #

**Note:** you need to cd first to where your docker-compose.yml file lives.

* Start containers in the background: `docker-compose up -d`
* Start containers on the foreground: `docker-compose up`. You will see a stream of logs for every container running.
  ctrl+c stops containers.
* Stop containers: `docker-compose stop`
* Kill containers: `docker-compose kill`
* View container logs: `docker-compose logs` for all containers or `docker-compose logs SERVICE_NAME` for the logs of
  all containers in `SERVICE_NAME`.
* Execute command inside of container: `docker-compose exec SERVICE_NAME COMMAND` where `COMMAND` is whatever you want
  to run. Examples:
  * Shell into the PHP container, `docker exec -it testarticles-php-fpm-1 bash`
  * Run symfony console, `docker exec testarticles-php-fpm-1 bin/console`
  * Open a mysql shell, `docker exec -it testarticles-mysql-1 mysql -uroot -pCHOSEN_ROOT_PASSWORD`

# Recommendations #

It's hard to avoid file permission issues when fiddling about with containers due to the fact that, from your OS point
of view, any files created within the container are owned by the process that runs the docker engine (this is usually
root). Different OS will also have different problems, for instance you can run stuff in containers
using `docker exec -it -u $(id -u):$(id -g) CONTAINER_NAME COMMAND` to force your current user ID into the process, but
this will only work if your host OS is Linux, not mac. Follow a couple of simple rules and save yourself a world of
hurt.

* Run composer outside of the php container, as doing so would install all your dependencies owned by `root` within your
  vendor folder.
* Run commands (ie Symfony's console, or Laravel's artisan) straight inside of your container. You can easily open a
  shell as described above and do your thing from there.

---------------

## Use : ##

# 1. Database generation #
```scala
bin/console doctrine:migrations:migrate
```

# 2. Load data fixtures to database #
```scala
bin/console doctrine:fixtures:load
```

# 3. API #
**Generate Bearer Token**
```scala
curl -X POST -H "Content-Type: application/json" http://localhost:64000/api/login_check -d '{"username":"admin@test.com","password":"admin"}'
```

**GET Comments**
```scala
curl --location 'http://localhost:64000/api/comment' \
--header 'Authorization: Bearer {*BEARER_TOKEN*}' 
```

**GET Pages**
```scala
curl --location 'http://localhost:64000/api/page' \
--header 'Authorization: Bearer {*BEARER_TOKEN*}' 
```

**POST Comment**
```scala
curl --location --request GET 'http://localhost:64000/api/comment/' \
--header 'Authorization: Bearer {*BEARER_TOKEN*}' \
--header 'Content-Type: application/json' \
--data '{
    "content": "My test comment...",
    "page": 1,
    "user": *USER_ID_AFTER_LOGIN_WITH_SOCIAL_NETWORKS*
}'
```

**POST Response**
```scala
curl --location --request GET 'http://localhost:64000/api/comment/' \
--header 'Authorization: Bearer {*BEARER_TOKEN*}' \
--header 'Content-Type: application/json' \
--data '{
    "content": "My test response to comment...",
    "parent": *COMMENT_ID*,
    "user": *USER_ID_AFTER_LOGIN_WITH_SOCIAL_NETWORKS*
}'
```

# 4. Application #
I let you discover :wink:.

---------------  
# Point of vigilance #  
| URL : http://localhost:64000 |
|-------------------------------|

> **Warning**
> Pay attention to the url, it is absolutely necessary to launch the application under port 64000.
This is the url used in the google console configuration.

