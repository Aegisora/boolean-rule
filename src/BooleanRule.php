<?php

namespace Aegisora\Rules;

use Aegisora\RuleContract\Exceptions\InvalidRuleContextException;
use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class BooleanRule extends Rule
{
    private bool $expected;

    private function __construct(
        bool $expected
    ) {
        $this->expected = $expected;
    }

    public static function createTruthy(): self
    {
        return new self(true);
    }

    public static function createFalsy(): self
    {
        return new self(false);
    }

    protected function executeValidate(Context $context): Result
    {
        $this->validateValue($context->getValue());

        return ($context->getValue() === $this->expected) ?
            $this->getDefaultValidResult() :
            $this->getDefaultInvalidResult();
    }

    /**
     * @param mixed $value
     * @throws InvalidRuleContextException
     */
    private function validateValue($value): void
    {
        if (is_bool($value)) {
            return;
        }

        throw new InvalidRuleContextException();
    }
}
