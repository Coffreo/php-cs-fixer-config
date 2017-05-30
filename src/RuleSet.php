<?php

/**
 * This file is part of Coffreo project "coffreo-toolbox/php-cs-fixer-config".
 *
 * (c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved
 *
 * This source file is subject to the proprietary license.
 */

namespace Coffreo\PhpCsFixer\Config;

interface RuleSet
{
    /**
     * @return string
     */
    public function name();

    /**
     * @return array
     */
    public function rules();

    /**
     * @return int
     */
    public function targetPhpVersion();
}
