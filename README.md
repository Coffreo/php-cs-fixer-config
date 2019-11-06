# php-cs-fixer-config

All credits goes to **[`localheinz/php-cs-fixer-config`](https://github.com/localheinz/php-cs-fixer-config)**.

This project is a fork with Coffreo rules and few changes to: 
* add header template feature
* add reading of composer.json datas to fullfill header template
* handle multiples version of `php-cs-fixer` in tests

This repository provides a configuration factory and multiple Coffreo rule sets for [`friendsofphp/php-cs-fixer`](http://github.com/FriendsOfPHP/PHP-CS-Fixer).

## Installation

Run

```sh
$ composer require --dev coffreo/php-cs-fixer-config
```

## Usage

### Configuration

Pick one of the rule sets:

* `Coffreo\PhpCsFixer\RuleSet\Php54` (includes migration 5.6 rules)
* `Coffreo\PhpCsFixer\RuleSet\Php54To56` (includes ONLY migration 5.6 rules)
* `Coffreo\PhpCsFixer\RuleSet\Php56`
* `Coffreo\PhpCsFixer\RuleSet\Php70`
* `Coffreo\PhpCsFixer\RuleSet\Php71`
* `Coffreo\PhpCsFixer\RuleSet\Php72`

:ledger: All configuration (except `Php54To56`) include `@Symfony` and `@PSR2` rules.

Create a configuration file `.php_cs` in the root of your project:

```php
<?php

use Coffreo\PhpCsFixer\Config;

// read composer
$composer = json_decode(file_get_contents(__DIR__."/composer.json"));
if (null === $composer) {
    throw new \Exception('Composer.json invalid. CS-Fixer aborted.');
}
$header = Config\HeaderHelper::coffreo(compact("composer"));

$config = Config\Factory::fromRuleSet(

    // CHOOSE YOUR RULE SET HERE
    new Config\RuleSet\Php54($header)

);
$config->getFinder()->in(__DIR__.'/src');
$config->setCacheFile(__DIR__.'/.php_cs.cache');

return $config;
```

### Git

Add `.php_cs.cache` (this is the cache file created by `php-cs-fixer`) to `.gitignore`:

```
vendor/
.php_cs.cache
```

### Makefile (optional)

Create a `Makefile` with a `cs` target:

```Makefile
.PHONY: composer cs

composer:
	composer validate
	composer install

cs: composer
	vendor/bin/php-cs-fixer fix --config=.php_cs --diff --verbose
```

:bulb: This can either be done with other scripting launcher (`npm run ..` or `composer run-script ..`)

## Developer commands

Few commands to know when updating this project:

```
$ make test   # run PHPUnit test suite
$ make cs     # Apply CS to source code (THIS MUST BE DONE BEFORE PUSHING)
$ make        # lazy ? execute both above commands
```

## FAQ

* I've installed everything but it keeps me warning that few rules are inexistents.

> You get thie error message because the version of `friendsofphp/php-cs-fixer` is not appropriate 
with selected rules set. Two potentials causes:
>  * Ensure your ruleset is compatible with your PHP version (56 for 5.6, 70 for 7.0, etc...)
>  * Check your composer.json for `config.platform` key. It should either be undefined or the correct value 
depending on your PHP version. The presence of this config key force composer to install cs-fixer 
version related to PHP version defined by this key, ignoring real current version of PHP.)
