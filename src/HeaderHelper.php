<?php

/**
 * This file is part of Coffreo project "coffreo-toolbox/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved
 *
 * This source file is subject to the proprietary license.
 */

namespace Coffreo\PhpCsFixer\Config;

/**
 * @author Cyril MERY <cmery@coffreo.com>
 */
class HeaderHelper
{
    public static function __callStatic($name, $arguments)
    {
        return self::fromTemplate($name.'.php', isset($arguments[0]) ? $arguments[0] : []);
    }

    public static function fromTemplate($name, array $parameters)
    {
        $template = null;
        if (file_exists($name)) {
            $template = $name;
        } elseif (file_exists(__DIR__.'/../resources/headers/'.$name)) {
            $template = realpath(__DIR__.'/../resources/headers/'.$name);
        }

        if (null === $template) {
            throw new \InvalidArgumentException(sprintf('Cannot find template "%s"', $template));
        }

        extract($parameters);

        return require $template;
    }
}
