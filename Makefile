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