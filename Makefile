.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: install-services

install-services:
	make install-apps -j
install-apps: install-api install-blog
install-api:
	@cd $(BASE_DIR)/backend && make
install-blog:
	@cd $(BASE_DIR)/pcu && make