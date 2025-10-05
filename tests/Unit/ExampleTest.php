<?php

/**
 * Copyright © MB Arbatos Klubas. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace FreshAdvance\OXIDPerLineVAT\Tests\Unit;

use FreshAdvance\OXIDPerLineVAT\Example;
use PHPUnit\Framework\TestCase;

final class ExampleTest extends TestCase
{
    public function testUnitExample(): void
    {
        $example = new Example();
        $this->assertTrue($example->test());
    }
}
