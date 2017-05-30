<?php

/**
 * This file is part of Coffreo project "coffreo-toolbox/php-cs-fixer-config".
 *
 * (c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved
 *
 * This source file is subject to the proprietary license.
 */

namespace Coffreo\PhpCsFixer\Config;

use PhpCsFixer\Config;

final class Factory
{
    /**
     * @param RuleSet $ruleSet
     *
     * @throws \RuntimeException
     *
     * @return Config
     */
    public static function fromRuleSet(RuleSet $ruleSet)
    {
        if (PHP_VERSION_ID < $ruleSet->targetPhpVersion()) {
            throw new \RuntimeException(\sprintf(
                'Current PHP version "%s is less than targeted PHP version "%s".',
                PHP_VERSION_ID,
                $ruleSet->targetPhpVersion()
            ));
        }

        $config = new Config($ruleSet->name());

        $config->setRiskyAllowed(true);
        $config->setRules($ruleSet->rules());

        return $config;
    }
}
