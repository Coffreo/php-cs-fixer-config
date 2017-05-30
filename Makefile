GITLAB_CI?=false

PHPUNIT_FLAGS=
CS_FLAGS=
ifeq ($(GITLAB_CI),true)
	CS_FLAGS=--dry-run --stop-on-violation --using-cache=no
	PHPUNIT_FLAGS=--coverage-text --colors=never
endif

.PHONY: composer cs it test

it: cs test

composer:
	rm -rf composer.lock
	composer self-update
	composer validate
	composer update

cs: composer
	vendor/bin/php-cs-fixer fix --config=.php_cs --verbose --diff $(CS_FLAGS)

test: composer
	vendor/bin/phpunit $(PHPUNIT_FLAGS)
	composer update --prefer-lowest
	vendor/bin/phpunit $(PHPUNIT_FLAGS)
