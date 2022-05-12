# VARIABLES
DOCKER_COMPOSE = docker-compose
CONTAINER      = container-minerva
EXEC           = docker exec -ti $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: create_env_file rebuild

deps: composer-install

update-deps: composer-update

test:
	$(EXEC) ./vendor/bin/phpunit
	@echo "Test Executed ✅"

#Linter
cs:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed ✅"

cs-prev:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed ✅"

#Static Analysis
stand:
	$(EXEC_PHP) ./vendor/bin/phpstan analyse --level 7 src tests Minerva

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi

# 🐘 Composer
composer-install: ACTION=install

composer-update: ACTION=update $(module)

composer-require: ACTION=require $(module)

composer-dump: ACTION=dump-autoload

composer composer-install composer-update composer-require composer-dump: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi

# 🐳 Docker Compose
start:
	@echo "🚀 Deploy!!!"
	$(DOCKER_COMPOSE) up -d
stop:
	@echo "🛑 Stop container!!!"
	$(DOCKER_COMPOSE) stop
recreate:
	@echo "🔥 Recreate container!!!"
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
	make start
	make deps
rebuild:
	@echo "🔥 Rebuild container!!!"
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make start
	make deps

# 🦝 Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

#clear cache
clear:
	$(SYMFONY) cache:clear

terminal:
	$(EXEC) /bin/bash