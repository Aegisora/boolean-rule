<?php

namespace Aegisora\Rules\Tests\Unit;

use Aegisora\RuleContract\RuleInterface;
use Aegisora\Rules\BooleanRule;
use PHPUnit\Framework\TestCase;

class BooleanRuleTest extends TestCase
{
    public function testCreateTruthy(): void
    {
        self::assertInstanceOf(RuleInterface::class, BooleanRule::createTruthy());
    }

    public function testCreateFalsy(): void
    {
        self::assertInstanceOf(RuleInterface::class, BooleanRule::createFalsy());
    }
}
