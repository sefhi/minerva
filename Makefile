CURRENT-DIR    	:= $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: install-services

install-services:
	make install-apps
install-apps: install-api install-blog
install-api:
	@cd $(CURRENT-DIR)/backend && make
install-blog:
	@cd $(CURRENT-DIR)/frontend && make

current:
	@echo $(CURRENT-DIR)

### Ejecución de las Apps
start:
	@docker-compose up -d
	@cd $(CURRENT-DIR)/backend && make start
	@cd $(CURRENT-DIR)/auth && make start
	@cd $(CURRENT-DIR)/frontend && make start
	reset
start-mysql:
	docker-compose up -d minerva-mysql
start-auth:
	@cd $(CURRENT-DIR)/auth && make start
stop:
	@cd $(CURRENT-DIR)/backend && make stop
	@cd $(CURRENT-DIR)/frontend && make stop