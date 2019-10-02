<?php

/**
 * This file is part of Coffreo project "coffreo/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\PhpCsFixer\Config\Test\Unit\RuleSet;

use Coffreo\PhpCsFixer\Config;
use PhpCsFixer\Console\Application;
use PhpCsFixer\Fixer;
use PhpCsFixer\FixerFactory;
use PhpCsFixer\RuleSet;
use PHPUnit\Framework;

abstract class AbstractRuleSetTestCase extends Framework\TestCase
{
    final public function testIsFinal()
    {
        $reflection = new \ReflectionClass($this->className());

        $this->assertTrue($reflection->isFinal());
    }

    final public function testImplementsRuleSetInterface()
    {
        $reflection = new \ReflectionClass($this->className());

        $this->assertTrue($reflection->implementsInterface(Config\RuleSet::class));
    }

    final public function testDefaults()
    {
        $ruleSet = $this->createRuleSet();

        $this->assertSame($this->name(), $ruleSet->name());
        $this->assertEquals($this->rules(), $ruleSet->rules());
        $this->assertEquals($this->targetPhpVersion(), $ruleSet->targetPhpVersion());
    }

    final public function testAllConfiguredRulesAreBuiltIn()
    {
        $this->checkPhpCsFixerVersion();

        $fixersNotBuiltIn = array_diff(
            $this->configuredFixers(),
            $this->builtInFixers()
        );

        $this->assertEmpty($fixersNotBuiltIn, sprintf(
            'Failed to assert that fixers for the rules "%s" are built in',
            implode('", "', $fixersNotBuiltIn)
        ));
    }

    final public function testAllBuiltInRulesAreConfigured()
    {
        $this->checkPhpCsFixerVersion();

        $fixersWithoutConfiguration = array_diff(
            $this->builtInFixers(),
            $this->configuredFixers()
        );

        $this->assertEmpty($fixersWithoutConfiguration, sprintf(
            'Failed to assert that built-in fixers for the rules "%s" are configured',
            implode('", "', $fixersWithoutConfiguration)
        ));
    }

    /**
     * @dataProvider providerInvalidHeader
     *
     * @param mixed $header
     */
    final public function testConstructorRejectsInvalidHeader($header)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'Header needs to be specified as null or a string. Got "%s" instead.',
            is_object($header) ? get_class($header) : gettype($header)
        ));

        $this->createRuleSet($header);
    }

    /**
     * @return \Generator
     */
    final public function providerInvalidHeader()
    {
        $values = [
            'array' => [],
            'boolean-true' => true,
            'boolean-false' => false,
            'float' => 3.14,
            'integer' => 90001,
            'object' => new \stdClass(),
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    /**
     * @dataProvider providerBlankHeader
     *
     * @param string $header
     */
    final public function testConstructorRejectsBlankHeader($header)
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf(
            'If specified, header needs to be a non-blank string. Got "%s" instead.',
            $header
        ));

        $this->createRuleSet($header);
    }

    /**
     * @return \Generator
     */
    final public function providerBlankHeader()
    {
        $values = [
            'string-empty' => '',
            'string-with-line-feed-only' => "\n",
            'string-with-spaces-only' => ' ',
            'string-with-tab-only' => "\t",
        ];

        foreach ($values as $key => $value) {
            yield $key => [
                $value,
            ];
        }
    }

    final public function testHeaderCommentFixerIsDisabledByDefault()
    {
        $rules = $this->createRuleSet()->rules();

        $this->assertArrayHasKey('header_comment', $rules);
        $this->assertFalse($rules['header_comment']);
    }

    final public function testHeaderCommentFixerIsEnabledIfHeaderIsProvided()
    {
        $header = 'foo';

        $rules = $this->createRuleSet($header)->rules();

        $this->assertArrayHasKey('header_comment', $rules);

        $expected = [
            'commentType' => 'PHPDoc',
            'header' => $header,
            'location' => 'after_declare_strict',
            'separate' => 'both',
        ];

        $this->assertSame($expected, $rules['header_comment']);
    }

    /**
     * @return string
     */
    abstract protected function className();

    /**
     * @return string
     */
    abstract protected function name();

    /**
     * @return array
     */
    abstract protected function rules();

    /**
     * @return int
     */
    abstract protected function targetPhpVersion();

    /**
     * @return bool
     */
    abstract protected function targetPhpCsFixer();

    final protected function checkPhpCsFixerVersion()
    {
        $target = $this->targetPhpCsFixer();
        if ($target && 0 === strpos(\PhpCsFixer\Console\Application::VERSION, $target)) {
            return;
        }

        throw new \PHPUnit_Framework_SkippedTestError(sprintf(
            'This test cannot be executed because current PHP-CS-FIXER version "%s" did not match current "%s" expected cs-fixer.',
            Application::VERSION, $this->className()));
    }

    /**
     * @param string $header
     *
     * @throws \InvalidArgumentException
     *
     * @return Config\RuleSet
     */
    final protected function createRuleSet($header = null)
    {
        $reflection = new \ReflectionClass($this->className());

        return $reflection->newInstance($header);
    }

    /**
     * @return string[]
     */
    private function builtInFixers()
    {
        static $builtInFixers;

        if (null === $builtInFixers) {
            $fixerFactory = FixerFactory::create();
            $fixerFactory->registerBuiltInFixers();

            $builtInFixers = array_map(function (Fixer\FixerInterface $fixer) {
                return $fixer->getName();
            }, $fixerFactory->getFixers());
        }

        return $builtInFixers;
    }

    /**
     * @return string[]
     */
    private function configuredFixers()
    {
        /**
         * RuleSet::create() removes disabled fixers, to let's just enable them to make sure they not removed.
         *
         * @see https://github.com/FriendsOfPHP/PHP-CS-Fixer/pull/2361
         */
        $rules = array_map(function () {
            return true;
        }, $this->createRuleSet()->rules());

        return array_keys(RuleSet::create($rules)->getRules());
    }
}
