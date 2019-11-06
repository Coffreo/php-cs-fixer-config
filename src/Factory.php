<?php

/**
 * This file is part of Coffreo project "coffreo/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\PhpCsFixer\Config;

use PhpCsFixer\Config;

final class Factory
{
    /**
     * @throws \RuntimeException
     *
     * @return Config
     */
    public static function fromRuleSet(RuleSet $ruleSet)
    {
        if (PHP_VERSION_ID < $ruleSet->targetPhpVersion()) {
            throw new \RuntimeException(\sprintf('Current PHP version "%s is less than targeted PHP version "%s".', PHP_VERSION_ID, $ruleSet->targetPhpVersion()));
        }

        $config = new Config($ruleSet->name());

        $config->setRiskyAllowed(true);
        $config->setRules($ruleSet->rules());

        return $config;
    }
}
