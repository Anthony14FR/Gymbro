SAIL = ./vendor/bin/sail
DKC = docker compose
EXEC_PHP = $(DKC) exec --user root php
MAKEFLAGS += --no-print-directory
.DEFAULT_GOAL = help

help:
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

## —— Initialisation ———————————————————————————————————————————————————————————
install: ## initialise the development environment
	@if [ ! -f .env ]; then \
		(echo "\033[0;33mcannot access '.env': No such file or directory\033[0m"; exit 1) \
	fi
	docker run --rm --interactive --tty --volume .:/app composer install --ignore-platform-reqs && \
	$(SAIL) up -d && \debug bar laravel
	$(SAIL) artisan key:generate && \
	$(SAIL) artisan migrate:fresh --force && \
	$(SAIL) artisan db:seed && \
	$(SAIL) npm install && \
	make clear && \
	$(SAIL) npm run dev
up: ## start containers in the background & start npm run watch
	$(SAIL) up -d && \
	$(SAIL) npm run dev

## —— Artisan ——————————————————————————————————————————————————————————————————
clear: ## cache invalidation (route, cache, config, view)
	$(SAIL) artisan route:clear && \
	$(SAIL) artisan cache:clear && \
	$(SAIL) artisan config:clear && \
	$(SAIL) artisan view:clear

reset: ## refresh database and seed
	$(SAIL) artisan migrate:fresh --seed
test: ## run tests
	$(SAIL) artisan test
tinker: ## exec a laravel shell
	$(SAIL) artisan tinker
seed-admin: ## assign role user
	$(SAIL) artisan seed:admin

## —— Tools ——————————————————————————————————————————————————————————————————
cs-fixer-check: ## get PHP code style violations
	$(SAIL) php vendor/bin/php-cs-fixer fix app/ --dry-run --diff
cs-fixer-fix: ## fix PHP code style violations
	$(SAIL) php vendor/bin/php-cs-fixer fix app/ --diff
phpstan: ## Run static analysis on PHP
	$(SAIL) php vendor/bin/phpstan analyse --memory-limit=250M
