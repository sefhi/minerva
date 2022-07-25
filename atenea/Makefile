# VARIABLES
DOCKER_COMPOSE = docker-compose
CONTAINER      = minerva-atenea
EXEC           = docker exec --user=root -t $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: create_env_file rebuild

deps: composer-install create-database migrate-force

update-deps: composer-update

test:
	docker exec $(CONTAINER) bin/phpunit --testsuite Unit
	docker exec $(CONTAINER) bin/phpunit --testsuite Functional

#Linter
cs:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed ✅"

cs-prev:
	$(EXEC_PHP) ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed ✅"

#Static Analysis
static:
	$(EXEC_PHP) ./vendor/bin/phpstan analyse --level 7 src tests Atenea

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi

# 🐘 Composer
composer-install ci: ACTION=install

composer-update: ACTION=update $(module)

composer-require cr: ACTION=require $(module)

composer-dump cd: ACTION=dump-autoload

composer composer-install ci composer-update composer-require cr composer-dump cd: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi

# 🐳 Docker Compose
start: create_env_file
	@echo "🚀 Deploy!!!"
	$(DOCKER_COMPOSE) up -d
start-atenea: create_env_file
	@echo "🚀 Deploy!!!"
	$(DOCKER_COMPOSE) up -d atenea
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

# 📦 Database
create-database:
	$(SYMFONY) doctrine:database:create --if-not-exists
	@echo "🎊 Database created!"

#migrations
migrate-force:
	$(SYMFONY) doctrine:migrations:migrate --no-interaction

#fixtures
fixtures:
	$(SYMFONY) doctrine:fixtures:load --no-interaction