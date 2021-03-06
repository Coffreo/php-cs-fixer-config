<?php

/**
 * This file is part of Coffreo project "coffreo/php-cs-fixer-config"
 *
 * (c) Coffreo SAS <contact@coffreo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Coffreo\PhpCsFixer\Config\Test\Unit;

use Coffreo\PhpCsFixer\Config;
use PHPUnit\Framework;

final class FactoryTest extends Framework\TestCase
{
    public function testIsFinal()
    {
        $reflection = new \ReflectionClass('Coffreo\PhpCsFixer\Config\Factory');

        $this->assertTrue($reflection->isFinal());
    }

    public function testFromRuleSetThrowsRuntimeExceptionIfCurrentPhpVersionIsLessThanTargetPhpVersion()
    {
        $targetPhpVersion = PHP_VERSION_ID + 1;

        $ruleSet = $this->createRuleSetMock();

        $ruleSet
            ->expects($this->never())
            ->method('name');

        $ruleSet
            ->expects($this->never())
            ->method('rules');

        $ruleSet
            ->expects($this->atLeastOnce())
            ->method('targetPhpVersion')
            ->willReturn($targetPhpVersion);

        $this->expectException('RuntimeException');
        $this->expectExceptionMessage(\sprintf(
            'Current PHP version "%s is less than targeted PHP version "%s".',
            PHP_VERSION_ID,
            $targetPhpVersion
        ));

        Config\Factory::fromRuleSet($ruleSet);
    }

    /**
     * @dataProvider providerTargetPhpVersion
     *
     * @param $targetPhpVersion
     */
    public function testFromRuleSetCreatesConfig($targetPhpVersion)
    {
        $name = 'foobarbaz';

        $rules = [
            'foo' => true,
            'bar' => [
                'baz',
            ],
        ];

        $ruleSet = $this->createRuleSetMock();

        $ruleSet
            ->expects($this->once())
            ->method('name')
            ->willReturn($name);

        $ruleSet
            ->expects($this->once())
            ->method('rules')
            ->willReturn($rules);

        $ruleSet
            ->expects($this->atLeastOnce())
            ->method('targetPhpVersion')
            ->willReturn($targetPhpVersion);

        $config = Config\Factory::fromRuleSet($ruleSet);

        $this->assertInstanceOf('PhpCsFixer\ConfigInterface', $config);
        $this->assertTrue($config->getUsingCache());
        $this->assertTrue($config->getRiskyAllowed());
        $this->assertSame($rules, $config->getRules());
    }

    /**
     * @return \Generator
     */
    public function providerTargetPhpVersion()
    {
        $values = [
            PHP_VERSION_ID - 1,
            PHP_VERSION_ID,
        ];

        foreach ($values as $value) {
            yield [
                $value,
            ];
        }
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|Config\RuleSet
     */
    private function createRuleSetMock()
    {
        return $this->createMock('Coffreo\PhpCsFixer\Config\RuleSet');
    }
}
