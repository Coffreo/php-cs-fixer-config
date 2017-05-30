<?php
use Coffreo\PhpCsFixer\Config;

$composer = json_decode(file_get_contents(__DIR__."/composer.json"));
if (null === $composer) {
    throw new \Exception('Composer.json invalid. CS-Fixer aborted.');
}
$header = Config\HeaderHelper::coffreo(compact("composer"));

$config = Config\Factory::fromRuleSet(
    new Config\RuleSet\Php56($header)
);

$config->getFinder()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/test');
$config->setCacheFile(__DIR__.'/.php_cs.cache');

return $config;
