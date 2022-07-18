# VARIABLES
DOCKER_COMPOSE = docker compose
CONTAINER      = minerva-auth
EXEC           = docker exec -ti --user=root $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer
CURRENT-DIR  := $(dir $(abspath $(lastword $(MAKEFILE_LIST))))
CURRENT_UID  := $(shell id -u)

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: create_env_file rebuild

deps: composer-install

update-deps: composer-update

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi
generate-private-key:
	@if [ ! -f .docker/config/private.key ]; then openssl genrsa -out .docker/config/private.key 2048; fi
generate-public-key:
	@if [ ! -f .docker/config/public.key ]; then openssl rsa -in .docker/config/private.key -pubout -out .docker/config/public.key; fi
# 🐘 Composer
composer-install ci: ACTION=install

composer-update: ACTION=update $(module)

composer-require cr: ACTION=require $(module)

composer composer-install ci composer-update composer-require cr: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi
# 🐳 Docker Compose
start: create_env_file generate-private-key generate-public-key
	@echo "🚀 Deploy!!!"
	@$(DOCKER_COMPOSE) up -d
	make deps
stop:
	$(DOCKER_COMPOSE) stop
down:
	$(DOCKER_COMPOSE) down
recreate:
	@echo "🔥 Recreate container!!!"
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make deps
rebuild:
	@echo "🔥 Rebuild container!!!"
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make start

# 🦝 Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

#clear cache
clear:
	$(SYMFONY) cache:clear

bash:
	$(DOCKER_COMPOSE) exec -it $(CONTAINER) /bin/bash
