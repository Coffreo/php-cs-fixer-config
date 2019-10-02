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
