# VARIABLES
DOCKER_COMPOSE = docker-compose
CONTAINER      = front-minerva
EXEC           = docker exec -ti $(CONTAINER)

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: rebuild

deps: npm-install

# 🐘 Composer
npm-install:
	$(EXEC) npm ci

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