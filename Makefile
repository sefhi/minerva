CURRENT-DIR    	:= $(dir $(abspath $(lastword $(MAKEFILE_LIST))))

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: start-mysql install-services

install-services:
	make install-apps
install-apps: install-atenea
install-atenea:
	@cd $(CURRENT-DIR)/atenea && make
#install-blog:
#	@cd $(CURRENT-DIR)/frontend && make

current:
	@echo $(CURRENT-DIR)

### Ejecución de las Apps
start:
	@docker-compose up -d
	@cd $(CURRENT-DIR)/atenea && make start
	@cd $(CURRENT-DIR)/auth && make start
#	@cd $(CURRENT-DIR)/frontend && make start
	reset
start-mysql:
	@docker-compose up -d minerva-mysql
start-auth:
	@cd $(CURRENT-DIR)/auth && make start
stop:
	@docker-compose stop
	@cd $(CURRENT-DIR)/atenea && make stop
	@cd $(CURRENT-DIR)/auth && make stop
	@cd $(CURRENT-DIR)/frontend && make stop