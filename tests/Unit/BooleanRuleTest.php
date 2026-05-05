<?php

namespace Aegisora\Rules\Tests\Unit;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
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

    /**
     * @dataProvider getTruthyTestProvidedData
     */
    public function testTruthy(
        Context $context,
        array $expectedResult
    ): void {
        self::assertActualResultEqualsExpected(
            BooleanRule::createTruthy()->validate($context),
            $expectedResult
        );
    }

    public static function getTruthyTestProvidedData(): array
    {
        return [
            'context value - true' => [
                'context' => Context::create(true),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - false' => [
                'context' => Context::create(false),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'boolean_rule',
                ],
            ],
        ];
    }

    /**
     * @dataProvider getInvalidContextProvidedData
     */
    public function testTruthyThrowsInvalidRuleContextException(Context $context): void
    {
        $this->expectException(InvalidRuleContextException::class);

        BooleanRule::createTruthy()->validate($context);
    }

    public static function getInvalidContextProvidedData(): array
    {
        return [
            'context value - zero integer' => [
                'context' => Context::create(0),
            ],
            'context value - positive integer' => [
                'context' => Context::create(1),
            ],
            'context value - negative integer' => [
                'context' => Context::create(-1),
            ],
            'context value - zero float' => [
                'context' => Context::create(0.0),
            ],
            'context value - positive float' => [
                'context' => Context::create(0.01),
            ],
            'context value - negative float' => [
                'context' => Context::create(-0.01),
            ],
            'context value - not empty string' => [
                'context' => Context::create('foo'),
            ],
        ];
    }

    private static function assertActualResultEqualsExpected(
        Result $result,
        array $expectedResult
    ): void {
        self::assertEquals($expectedResult['isValid'], $result->isValid());
        self::assertEquals($expectedResult['failedRuleCode'], $result->getFailedRuleCode());
    }
}
