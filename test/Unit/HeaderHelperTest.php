<?php

/**
 * This file is part of Coffreo project "coffreo-toolbox/php-cs-fixer-config".
 *
 * (c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved
 *
 * This source file is subject to the proprietary license.
 */

namespace Coffreo\PhpCsFixer\Config\Test\Unit;

use Coffreo\PhpCsFixer\Config\HeaderHelper;
use PHPUnit\Framework;

class HeaderHelperTest extends Framework\TestCase
{
    public function testFromTemplate()
    {
        $composer = '{"name": "NAME"}';
        $params = ['composer' => json_decode($composer)];

        $expected = <<<HEADER
This file is part of Coffreo project "NAME"

(c) Coffreo SAS <contact@coffreo.com> - All Rights Reserved

This source file is subject to the proprietary license.
HEADER;

        $this->assertEquals($expected, HeaderHelper::fromTemplate('coffreo.php', $params));
        $this->assertEquals($expected, HeaderHelper::fromTemplate(__DIR__.'/../../resources/headers/coffreo.php', $params));
        $this->assertEquals($expected, HeaderHelper::coffreo($params));

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot find template');
        HeaderHelper::fromTemplate('INEXISTENT_TEMPLATE', $params);
    }
}
