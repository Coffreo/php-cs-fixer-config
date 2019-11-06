<?php

/**
 * This file is part of Coffreo project "coffreo/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\PhpCsFixer\Config\RuleSet;

use Coffreo\PhpCsFixer\Config\RuleSet;

/**
 * @internal
 */
abstract class AbstractRuleSet implements RuleSet
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $rules = [];

    /**
     * @var int
     */
    protected $targetPhpVersion;

    /**
     * @param string $header
     *
     * @throws \InvalidArgumentException
     */
    final public function __construct($header = null)
    {
        if (null === $header) {
            return;
        }

        if (!\is_string($header)) {
            throw new \InvalidArgumentException(\sprintf('Header needs to be specified as null or a string. Got "%s" instead.', \is_object($header) ? \get_class($header) : \gettype($header)));
        }

        if ('' === \trim($header)) {
            throw new \InvalidArgumentException(\sprintf('If specified, header needs to be a non-blank string. Got "%s" instead.', $header));
        }

        $this->rules['header_comment'] = [
            'commentType' => 'PHPDoc',
            'header' => $header,
            'location' => 'after_declare_strict',
            'separate' => 'both',
        ];
    }

    final public function name()
    {
        return $this->name;
    }

    final public function rules()
    {
        return $this->rules;
    }

    final public function targetPhpVersion()
    {
        return $this->targetPhpVersion;
    }
}
